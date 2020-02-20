<?php

/**
 * Obtiene todas las categorias de las encuestas
 * 
 * @return array Arreglo con los Registros de Categorias
 */

//Lbreria de acceso a base de datos
require_once 'libs/dao.php';

function obtenerTodasCategorias()
{
    $arrCategorias = array(); //Para guardar los datos
    $strSelect = "SELECT * FROM categorias;"; //Crear 
    $arrCategorias = obtenerRegistros($strSelect); //Si no se manda usa la conexion por defecto, que ya establecimos nosotros arriba

    return $arrCategorias;    
}

//No se llama porque es de consumo no de accion

?>