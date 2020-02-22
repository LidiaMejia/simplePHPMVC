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
    $sqlSelect = "SELECT * FROM colores;";

    $arrColores = obtenerRegistros($sqlSelect); 

    return $arrColores;
}


//INSERT NUEVO COLOR
function insertColor($colorhxd, $colordsc, $colorobs)
{
    $sqlInsert = "INSERT INTO colores (colorhxd, colordsc, colorobs) VALUES ('%s', '%s', '%s');";
    $isOK = ejecutarNonQuery(
        sprintf($sqlInsert, $colorhxd, $colordsc, $colorobs) 
    );

    return getLastInserId();
}

?>