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
        sprintf($sqlIns, $ctgdsc, $ctgest) //Funcion por defecto para ejecutar querys. Se manda el query y los datos a llenar. RETORNA LA CANTIDAD DE FILAS AFECTADAS || 0 si no se afecto || false si hubo un error
    ); 
    
    return getLastInserId(); //Retorna el ultimo Id Autonumerico que se creo. SOLO PARA AUTONUMERICOS
}


//Funcion para obtener los datos de un regustro especifico
function obtenerCategoriaPorCodigo($ctgcod)
{
    $sqlSelect = "SELECT * FROM categorias WHERE ctgcod = %d;";

    // !!!!!!!!!!!!!!   RETORNAR ESE REGISTRO PARA MOSTRARLO   !!!!!!!!!!!!!!!!!!!!
    return obtenerUnRegistro(
        sprintf($sqlSelect, $ctgcod)
    ); 
}

//Actualizar una categoria
function actualizarCategoria($ctgcod, $ctgdsc, $ctgest)
{
    $sqlUpdate = "UPDATE categorias set ctgdsc = '%s', ctgest = '%s' WHERE ctgcod = %d;";

    return ejecutarNonQuery(
        sprintf($sqlUpdate, $ctgdsc, $ctgest, $ctgcod) //SE MANDAN EN EL ORDEN DE LA CADENA SQL
    );
}

//Eliminar una categoria
function eliminarCategoria($ctgcod)
{
    $sqlDelete = "DELETE from categorias WHERE ctgcod = %d;";

    return ejecutarNonQuery(
        sprintf($sqlDelete, $ctgcod)
    );
}

?>