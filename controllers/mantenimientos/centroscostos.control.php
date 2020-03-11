<?php

/**
 * 
 * @return void
 */

 require_once "models/mantenimientos/centroscostos.model.php";

 function run()
 {
    $arrViewData = array();

    $arrViewData['centroscostos'] = obtenerTodosCC();

    renderizar("mantenimientos/centroscostos", $arrViewData);
 }

 run();

?>