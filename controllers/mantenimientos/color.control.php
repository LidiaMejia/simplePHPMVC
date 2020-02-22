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

    if(isset($_POST['botGuardar']))
    {
        insertColor($_POST['colorhxd'], $_POST['colordsc'], $_POST['colorobs']); 

        redirectWithMessage("Color Guardado Exitosamente", "index.php?page=colores");
        die();
    }

    renderizar("mantenimientos/color", $arrViewData);
}

run();


?>