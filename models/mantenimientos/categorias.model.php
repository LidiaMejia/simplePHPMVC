<?php

/**
 * Obtiene todas las categorias de las encuestas
 * 
 * @return array Arreglo con los Registros de Categorias
 */

//Lbreria de acceso a base de datos
require_once 'libs/dao.php';

//Crear Funcion para obtener Todas las Categorias
function obtenerTodasCategorias()
{
    $arrCategorias = array(); //Para guardar los datos
    $sqlSelect = "SELECT * FROM categorias;"; //Crear el query
    $arrCategorias = obtenerRegistros($sqlSelect); //Si no se manda usa la conexion por defecto, que ya establecimos nosotros arriba

    return $arrCategorias;    
}

//Crear Funcion para GUARDAR NUEVA CATEGORIA
function guardarNuevaCategoria($ctgdsc, $ctgest)
{
    $sqlIns = "INSERT into categorias (ctgdsc, ctgest) VALUES ('%s', '%s');"; //Crear el query
    $isOK = ejecutarNonQuery(
        sprintf($sqlIns, $ctgdsc, $ctgest) //Funcion por defecto para ejecutar querys. Se manda el query y los datos a llenar
    ); 
    
    return getLastInserId(); //Retorna el ultimo Id Autonumerico que se creo
}

//No se llama porque es de consumo no de accion. SE LLAMA EN EL CONTROLADOR

?>