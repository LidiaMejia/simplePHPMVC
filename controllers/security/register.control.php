<?php

/**
 * Registro de Usuarios al Sistema
 * 
 * @return void
 */

 require_once "models/security/security.model.php";  //INCLUIR EL MODELO DE DATOS YA ESTABLECIDO PARA SEGURIDAD EN EL REGISTRO DEL USUARIO
 require_once "libs/validadores.php"; //Funciones de Validacion para SERVIDOR

function run()
{
    //Se traen los nombres de los datos de la funcion de Ingresar Nuevo Usuario de security
    $arrViewData = array();
    
    $arrViewData['userName'] = '';
    $arrViewData['userEmail'] = '';
    $arrViewData['timestamp'] = '';
    $arrViewData['password'] = '';
    $arrViewData['passwordCnf'] = ''; 
    $arrViewData['userType'] = 'PUB'; //Tiene acceso a la parte publica

    //Para los errores a NIVEL DE SERVIDOR
    $arrViewData['hasErrors'] = false;
    $arrViewData['errors'] = array();


    //VERIFICAMOS DIRECTAMENTE EL POST
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        //Token
        if( isset($_POST['token']) && isset($_SESSION['token_register']) && $_POST['token'] === $_SESSION['token_register'] )
        {
            //Refresh variables del form
            $arrViewData['userEmail'] = $_POST['userEmail'];
            $arrViewData['password'] = $_POST['password'];
            $arrViewData['passwordCnf'] = $_POST['passwordCnf'];

            //VALIDACIONES DE SERVIDOR. SE USAN LAS DE LIBS - Aqui se mandan al div del inicio del view
            if(!isValidEmail($arrViewData['userEmail']))
            {
                $arrViewData['hasErrors'] = true;
                $arrViewData['errors'][] = "Correo con formato incorrecto";
            }

            if(!isValidPassword($arrViewData['password']))
            {
                $arrViewData['hasErrors'] = true;
                $arrViewData['errors'][] = "Contraseña con formato incorrecto";
            }

            if($arrViewData['password'] !== $arrViewData['passwordCnf'])
            {
                $arrViewData['hasErrors'] = true;
                $arrViewData['errors'][] = "Las contraseñas no coinciden";
            }

            //Si no hay errores
            if(!$arrViewData['hasErrors'])
            {
                //Se verifica si ya esta registrado ese correo
                $usuario = obtenerUsuarioPorEmail($arrViewData['userEmail']);

                //Si es nuevo
                if(count($usuario) == 0)
                {
                    $pswd = $arrViewData['password'];
                    $fchIngreso = time();
                    $pswdSalted = "";

                    if($fchIngreso % 2 == 0)
                    {
                        $pswdSalted = $pswd . $fchIngreso;
                    }
                    else
                    {
                        $pswdSalted = $fchIngreso . $pswd;
                    }

                    $pswdSalted = md5($pswdSalted);

                    //Insertar Usuario a la Base
                    $result = insertUsuario('', $arrViewData['userEmail'], $fchIngreso, $pswdSalted, $arrViewData['userType']);
                    
                    //Si se inserto correctamente
                    if($result)
                    {
                        //Asegurarse de que el rol existe
                        agregarRolaUsuario('Publico', $result);

                        //Aqui se pueden agregar roles especificos

                        redirectWithMessage("Cuenta Creada Satisfactoriamente, Favor Ingresar", "index.php?page=login");
                    }
                } 
                else
                {
                    error_log("Intento de crear cuenta con correo existente de " . $usuario['userCode']);
                    $arrViewData['hasErrors'] = true;
                    $arrViewData['errors'][] = "Error al registrar cuenta"; 
                }       
            }
        }
        else
        {
            error_log("Intento de Ataque XRS de " . $_SERVER['REMOTE_ADDR']);
        }
    }

    //Token
    $xrsToken = md5(time() . random_int(0,10000) . "register");
    $arrViewData['token'] = $xrsToken;
    $_SESSION['token_register'] = $xrsToken;

    //libs / Utilities
    //hay una funcion para poder agregar una js (Se escribe su ruta relativa)
    addJsRef('public/js/validators.js'); 
    
    renderizar("register", $arrViewData);
}

run();

?>