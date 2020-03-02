<?php

/**
 * Control para ingreso de Nuevo Color
 * 
 * @return void
 */

 require_once "models/mantenimientos/colores.model.php";

function run()
{
    $arrViewData = array();

    $arrDescMode = array(
        'INS' => "Ingresar Nuevo Color",
        'UPD' => "Actualizar Color %s - %s",
        'DEL' => "Eliminar Color %s - %s",
        'DSP' => "Color %s - %s"
    );

    //Inicializar Datos
    $arrViewData['colorcod'] = 0;
    $arrViewData['colorhxd'] = '';
    $arrViewData['colordsc'] = '';
    $arrViewData['colorobs'] = '';
    $arrViewData['colorest'] = 'ACT';
    $arrViewData['colorEstACTTrue'] = '';
    $arrViewData['colorEstINATrue'] = '';
    $arrViewData['mode'] = 'INS';

    //Determinar Metodo

    //CARGA DE LA URL
    if($_SERVER["REQUEST_METHOD"] === "GET")
    {
        //Si se trajo un modo
        if(isset($_GET['mode']))
        {
            $arrViewData['mode'] = $_GET['mode'];
            $arrViewData['colorcod'] = intval($_GET['colorcod']); 
        }

        //Si el codigo pertenece a un color seleccionado y el modo no es insertar, guardo los datos de ese color para mostrarlo
        if($arrViewData['mode'] !== 'INS' && $arrViewData['colorcod'] > 0)
        {
            $arrTempColor = obtenerColorPorCodigo($arrViewData['colorcod']);

            mergeFullArrayTo($arrTempColor, $arrViewData);
        }
    }

    //Boton
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        //Verificar token de seguridad
        if( isset($_POST['token']) && isset($_SESSION['token_color']) && $_POST['token'] === $_SESSION['token_color'])
        {
            //Refrescar variables
            $arrViewData['colorcod'] = intval($_POST['colorcod']);
            $arrViewData['colorhxd'] = $_POST['colorhxd'];
            $arrViewData['colordsc'] = $_POST['colordsc'];
            $arrViewData['colorobs'] = $_POST['colorobs'];
            $arrViewData['colorest'] = $_POST['colorest'];
            $arrViewData['mode'] = $_POST['mode']; //NO OLVIDAR EL mode!!!!!   

            //Ver que accion se realiza
            switch($arrViewData['mode'])
            {
                case 'INS':
                    insertColor($arrViewData['colorhxd'], $arrViewData['colordsc'], $arrViewData['colorobs'], $arrViewData['colorest']);
                    redirectWithMessage("Color Guardado Exitosamente", "index.php?page=colores");
                break;

                case 'UPD':
                    actualizarColor($arrViewData['colorcod'], $arrViewData['colorhxd'], $arrViewData['colordsc'], $arrViewData['colorobs'], $arrViewData['colorest']);
                    redirectWithMessage("Color Actualizado Exitosamente", "index.php?page=colores");
                break;

                case 'DEL':
                    eliminarColor($arrViewData['colorcod']);
                    redirectWithMessage("Color Eliminado Exitosamente", "index.php?page=colores");   
                break;
            }
        }
    }

    //Token de Seguridad
    $xrsToken = md5(time() . random_int(0,10000) . "color");
    $_SESSION['token_color'] = $xrsToken;
    $arrViewData['token'] = $xrsToken; 

    //Titulo de la Pagina
    $arrViewData['modedsc'] = sprintf($arrDescMode[$arrViewData['mode']], $arrViewData['colorcod'], $arrViewData['colordsc']);

    //Seleccionado del ComboBox segun BDD
    $arrViewData['colorEstACTTrue'] = ($arrViewData['colorest'] == 'ACT')? "selected": "";
    $arrViewData['colorEstINATrue'] = ($arrViewData['colorest'] == 'INA')? "selected": "";

    //Deshabilitar campos cuando sea ver y eliminar
    $arrViewData['isReadOnly'] = false;

    if($arrViewData['mode'] === 'DSP' || $arrViewData['mode'] === 'DEL')
    {
        $arrViewData['isReadOnly'] = true;
    }

    //Deshabilitar boton "Guardar" cuando sea Ver
    $arrViewData['hasAction'] = true;

    if($arrViewData['mode'] === 'DSP')
    {
        $arrViewData['hasAction'] = false;
    }

    renderizar("mantenimientos/color", $arrViewData);
}

run();


?>