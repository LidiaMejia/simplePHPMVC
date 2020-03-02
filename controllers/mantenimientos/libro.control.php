<?php

/**
 * Controlador para el CRUD de libros
 * 
 * @return void
 */

 require_once "models/mantenimientos/libros.model.php";

 function run()
 {
     $arrViewData = array();

     //Inicializar Variables
     $arrViewData['librocod'] = 0;
     $arrViewData['libronom'] = '';
     $arrViewData['libroautor'] = '';
     $arrViewData['libroest'] = "DIS";
     $arrViewData['libroEstDISTrue'] = ''; 
     $arrViewData['libroEstNODTrue'] = '';
     $arrViewData['mode'] = 'INS';

     //Modos de Trabajo
     $arrModes = array(
        'INS' => "Ingresar Nuevo Libro",
        'UPD' => "Editar Libro %s - %s",
        'DEL' => "Eliminar Libro %s - %s",
        'DSP' => "Libro %s - %s"
     );

     //GET
     if($_SERVER["REQUEST_METHOD"] === "GET")
     {
         if(isset($_GET['mode']))
         {
             $arrViewData['mode'] = $_GET['mode'];
             $arrViewData['librocod'] = $_GET['librocod'];
         }

         if($arrViewData['mode'] !== 'INS' && $arrViewData['librocod'] > 0)
         {
             $arrTemp = datosUnLibro($arrViewData['librocod']);

             mergeFullArrayTo($arrTemp, $arrViewData);
         }
     }

     //POST
     if($_SERVER["REQUEST_METHOD"] === "POST")
     {
        //verificar token
        if(isset($_POST['token']) && isset($_SESSION['token_libro']) && $_POST['token'] === $_SESSION['token_libro'])
        {
            //Refresh de variables
            $arrViewData['librocod'] = intval($_POST['librocod']);
            $arrViewData['libronom'] = $_POST['libronom'];
            $arrViewData['libroautor'] = $_POST['libroautor'];
            $arrViewData['libroest'] = $_POST['libroest'];
            $arrViewData['mode'] = $_POST['mode'];

            switch($arrViewData['mode'])
            {
                case 'INS':
                    insertarLibro($arrViewData['libronom'], $arrViewData['libroautor'], $arrViewData['libroest']);
                    redirectWithMessage("Libro Guardado Exitosamente", "index.php?page=libros");
                break;

                case 'UPD':
                    updateLibro($arrViewData['librocod'], $arrViewData['libronom'], $arrViewData['libroautor'], $arrViewData['libroest']);
                    redirectWithMessage("Libro Editado Exitosamente", "index.php?page=libros");
                break;

                case 'DEL':
                    eliminarLibro($arrViewData['librocod']);
                    redirectWithMessage("Libro Eliminado Exitosamente", "index.php?page=libros");
                break;
            }
        }
        else
        {
            error_log("Intento de Ataque XRS de " . $_SERVER["REMOTE_ADDR"]);
        }
     }


     ///////////////GLOBALES

     //Token
     $xrsToken = md5(time() . random_int(0,10000) . "lib");
     $_SESSION['token_libro'] = $xrsToken;
     $arrViewData['token'] = $xrsToken; 

     //Titulo
     $arrViewData['modedsc'] = sprintf($arrModes[$arrViewData['mode']], $arrViewData['librocod'], $arrViewData['libronom']);

     //ComboBox
     $arrViewData['libroEstDISTrue'] = ($arrViewData['libroest'] === 'DIS')? "selected" : "";
     $arrViewData['libroEstNODTrue'] = ($arrViewData['libroest'] === 'NOD')? "selected" : "";

     //Deshabilitar campos en ver y eliminar
     $arrViewData['isReadOnly'] = false;

     if($arrViewData['mode'] === 'DEL' || $arrViewData['mode'] === 'DSP')
     {
        $arrViewData['isReadOnly'] = true;
     }

     //Quitar boton Guardar en ver
     $arrViewData['hasAction'] = true;

     if($arrViewData['mode'] === 'DSP')
     {
        $arrViewData['hasAction'] = false;
     }


     renderizar("mantenimientos/libro", $arrViewData);
 }

 run();

?>