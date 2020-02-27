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
function insertColor($colorhxd, $colordsc, $colorobs, $colorest)
{
    $sqlInsert = "INSERT INTO colores (colorhxd, colordsc, colorobs, colorest) VALUES ('%s', '%s', '%s', '%s');";
    $isOK = ejecutarNonQuery(
        sprintf($sqlInsert, $colorhxd, $colordsc, $colorobs, $colorest) 
    );

    return getLastInserId();
}


//OBTENER DATOS DE UN COLOR
function obtenerColorPorCodigo($colorcod)
{
    $sqlSelect = "SELECT * FROM colores WHERE colorcod = %d;";

    return obtenerUnRegistro(
        sprintf($sqlSelect, $colorcod)
    );
}


//ACTUALIZAR UN COLOR
function actualizarColor($colorcod, $colorhxd, $colordsc, $colorobs, $colorest)
{
    $sqlUpdate = "UPDATE colores SET colorhxd = '%s', colordsc = '%s', colorobs = '%s', colorest = '%s' WHERE colorcod = %d;";

    return ejecutarNonQuery(
        sprintf($sqlUpdate, $colorhxd, $colordsc, $colorobs, $colorest, $colorcod)
    );
}


//ELIMINAR UN COLOR
function eliminarColor($colorcod)
{
    $sqlDelete = "DELETE FROM colores WHERE colorcod = %d;";

    return ejecutarNonQuery(
        sprintf($sqlDelete, $colorcod)
    );
}


?>