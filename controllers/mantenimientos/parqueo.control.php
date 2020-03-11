<?php

/**
 * 
 * @return void
 */

 require_once "models/mantenimientos/parqueos.model.php";

 function run()
 {
    $arrViewData = array();

    //Mode
    $arrModeDsc = array(
        'INS' => "Insertar Nuevo Parqueo",
        'UPD' => "Editar %s - %s",
        'DEL' => "Eliminar %s - %s",
        'DSP' => "Parqueo %s - %s"
    );

    //Inicializar Variables
    $arrViewData['parqueoId'] = 0;
    $arrViewData['parqueoEst'] = '';
    $arrViewData['parqueoEstAVLTrue'] = '';
    $arrViewData['parqueoEstOCPTrue'] = '';
    $arrViewData['parqueoEstRSVTrue'] = '';
    $arrViewData['parqueoLot'] = '';
    $arrViewData['parqueoTip'] = '';
    $arrViewData['parqueoTipMOTTrue'] = '';
    $arrViewData['parqueoTipCARTrue'] = '';
    $arrViewData['parqueoTipTRKTrue'] = '';
    $arrViewData['mode'] = 'INS';

    //GET (URL)
    if($_SERVER["REQUEST_METHOD"] === "GET")
    {
        if(isset($_GET['mode']))
        {
            $arrViewData['mode'] = $_GET['mode']; 
            $arrViewData['parqueoId'] = intval($_GET['parqueoId']);
        }

        if($arrViewData['mode'] !== 'INS' && $arrViewData['parqueoId'] > 0)
        {
            $arrTemp = obtenerUnParqueo($arrViewData['parqueoId']);
            mergeFullArrayTo($arrTemp, $arrViewData);
        }
    }

    //POST
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        //Verificar Token
        if(isset($_POST['token']) && isset($_SESSION['token_parqueos']) && $_POST['token'] === $_SESSION['token_parqueos'])
        {
            //Refresh variables con valores del form
            $arrViewData['parqueoId'] = intval($_POST['parqueoId']);
            $arrViewData['parqueoEst'] = $_POST['parqueoEst'];
            $arrViewData['parqueoLot'] = $_POST['parqueoLot'];
            $arrViewData['parqueoTip'] = $_POST['parqueoTip'];
            $arrViewData['mode'] = $_POST['mode'];

            //Accion
            switch($arrViewData['mode'])
            {
                case 'INS':
                    insertarParqueo($arrViewData['parqueoEst'], $arrViewData['parqueoLot'], $arrViewData['parqueoTip']);
                    redirectWithMessage("Parqueo Insertado Correctamente", "index.php?page=parqueos");
                break;

                case 'UPD':
                    actualizarParqueo($arrViewData['parqueoId'], $arrViewData['parqueoEst'], $arrViewData['parqueoLot'], $arrViewData['parqueoTip']);
                    redirectWithMessage("Parqueo Actualizado Correctamente", "index.php?page=parqueos");
                break;

                case 'DEL':
                    eliminarParqueo($arrViewData['parqueoId']);
                    redirectWithMessage("Parqueo Eliminado Correctamente", "index.php?page=parqueos");
                break; 
            }
        }
        else
        {
            error_log("INTENTO DE ATAQUE XRS DE " . $_SERVER['REMOTE_ADDR']); 
        }
    }

    /////GLOBALES 

    //Token de Seguridad
    $xrsToken = md5(time() . random_int(0,10000) . "parq"); 
    $arrViewData['token'] = $xrsToken;
    $_SESSION['token_parqueos'] = $xrsToken;


    $arrViewData['modedsc'] = sprintf($arrModeDsc[$arrViewData['mode']], $arrViewData['parqueoId'], $arrViewData['parqueoLot']);

    //Ver seleccionado ComboBox
    $arrViewData['parqueoEstAVLTrue'] = ($arrViewData['parqueoEst'] === "AVL")? "selected" : "";
    $arrViewData['parqueoEstOCPTrue'] = ($arrViewData['parqueoEst'] === "OCP")? "selected" : "";
    $arrViewData['parqueoEstRSVTrue'] = ($arrViewData['parqueoEst'] === "RSV")? "selected" : ""; 

    $arrViewData['parqueoTipMOTTrue'] = ($arrViewData['parqueoTip'] === "MOT")? "selected" : "";
    $arrViewData['parqueoTipCARTrue'] = ($arrViewData['parqueoTip'] === "CAR")? "selected" : "";
    $arrViewData['parqueoTipTRKTrue'] = ($arrViewData['parqueoTip'] === "TRK")? "selected" : "";

    //Campos segun el modo
    $arrViewData['isReadOnly'] = false;
    
    if($arrViewData['mode'] === 'DSP' || $arrViewData['mode'] === 'DEL')
    {
        $arrViewData['isReadOnly'] = true;
    }

    $arrViewData['hasAction'] = true;

    if($arrViewData['mode'] === 'DSP')
    {
        $arrViewData['hasAction'] = false;
    }

    renderizar("mantenimientos/parqueo", $arrViewData);
 }

 run();


?>