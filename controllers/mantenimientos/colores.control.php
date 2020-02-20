<?php

/**
 * 
 * @return void
 */

require_once "models/mantenimientos/colores.model.php";

function run()
{
    $arrViewData = array();
    $arrViewData['colores'] = obtenerTodosColores();

    renderizar("mantenimientos/colores", $arrViewData); 
}

run();

?>