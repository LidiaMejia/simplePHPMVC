<?php

/**
 * 
 * @return void
 */

 require_once "models/mantenimientos/centroscostos.model.php";

 function run()
 {
    $arrViewData = array();

    $arrModeDsc = array(
        'INS' => "Nuevo Centro de Costos",
        'UPD' => "Editar CC %s - %s",
        'DEL' => "Eliminar CC %s - %s",
        'DSP' => "CC %s - %s"
    );

    //Variables
    $arrViewData['ccid'] = 0;
    $arrViewData['ccdsc'] = "";
    $arrViewData['ccest'] = "ACT";
    $arrViewData['ccestACTTrue'] = "";
    $arrViewData['ccestINATrue'] = "";
    $arrViewData['cctipo'] = "";
    $arrViewData['cctipoNACTrue'] = "";
    $arrViewData['cctipoINTTrue'] = "";
    $arrViewData['cctipoMUNTrue'] = "";
    $arrViewData['mode'] = 'INS';
    $arrViewData['modedsc'] = "";

    //GET (URL)
    if($_SERVER["REQUEST_METHOD"] === "GET")
    {
        if(isset($_GET['mode']))
        {
            $arrViewData['ccid'] = intval($_GET['ccid']);
            $arrViewData['mode'] = $_GET['mode'];
        }

        if($arrViewData['mode'] !== 'INS' && $arrViewData['ccid'] > 0)
        {
            $arrTemp = obtenerUnCC($arrViewData['ccid']);
            mergeFullArrayTo($arrTemp, $arrViewData); 
        }
    }

    //POST
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        //Verificar Token Seguridad
        if(isset($_POST['token']) && isset($_SESSION['token_cc']) && $_POST['token'] === $_SESSION['token_cc'])
        {
            //Refresh de Variables
            $arrViewData['ccid'] = intval($_POST['ccid']);
            $arrViewData['ccdsc'] = $_POST['ccdsc'];
            $arrViewData['ccest'] = $_POST['ccest'];
            $arrViewData['cctipo'] = $_POST['cctipo'];
            $arrViewData['mode'] = $_POST['mode'];  

            //Mode
            switch($arrViewData['mode'])
            {
                case "INS":
                    insertarCC($arrViewData['ccdsc'], $arrViewData['ccest'], $arrViewData['cctipo']);
                    redirectWithMessage("Guardado Exitoso", "index.php?page=centroscostos");
                break;

                case "UPD":
                    editarCC($arrViewData['ccid'], $arrViewData['ccdsc'], $arrViewData['ccest'], $arrViewData['cctipo']);
                    redirectWithMessage("Editado Exitoso", "index.php?page=centroscostos");
                break;

                case "DEL":
                    eliminarCC($arrViewData['ccid']);
                    redirectWithMessage("Eliminado Exitoso", "index.php?page=centroscostos");
                break;
            }
        }
        else
        {
            error_log("INTENTO DE ATAQUE XRS DE " . $_SERVER["REMOTE_ADDR"]);
        }
    }

    /////GLOBALES

    //Token
    $xrsToken = md5(time() . (random_int(0,10000)) . "cc");
    $arrViewData['token'] = $xrsToken;
    $_SESSION['token_cc'] = $xrsToken;

    //Titulo
    $arrViewData['modedsc'] = sprintf($arrModeDsc[$arrViewData['mode']], $arrViewData['ccid'], $arrViewData['ccdsc']);

    //Combobox
    $arrViewData['ccestACTTrue'] = ($arrViewData['ccest'] === "ACT")? "selected": "";
    $arrViewData['ccestINATrue'] = ($arrViewData['ccest'] === "INA")? "selected": "";

    $arrViewData['cctipoNACTrue'] = ($arrViewData['cctipo'] === "NAC")? "selected": "";
    $arrViewData['cctipoINTTrue'] = ($arrViewData['cctipo'] === "INT")? "selected": "";
    $arrViewData['cctipoMUNTrue'] = ($arrViewData['cctipo'] === "MUN")? "selected": "";

    //Campos segun mode
    $arrViewData['isReadOnly'] = false;

    if($arrViewData['mode'] === "DEL" || $arrViewData['mode'] === "DSP")
    {
        $arrViewData['isReadOnly'] = true;
    }

    $arrViewData['hasAction'] = true;

    if($arrViewData['mode'] === "DSP")
    {
        $arrViewData['hasAction'] = false;
    }


    renderizar("mantenimientos/centrocostos", $arrViewData);
 }

 run();

?>