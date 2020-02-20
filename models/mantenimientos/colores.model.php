<?php

/**
 * 
 * 
 * @return array
 */

require_once "libs/dao.php";

function obtenerTodosColores()
{
    $arrColores = array();
    $sqlstr = "SELECT * FROM colores;";

    $arrColores = obtenerRegistros($sqlstr);

    return $arrColores;
}


?>