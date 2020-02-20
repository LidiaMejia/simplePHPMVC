<?php

require_once 'models/mantenimientos/categorias.model.php'; //SE INCLUYE EL ACCESO AL MODELO DE DATOS DONDE ESTAN LAS CATEGORIAS

/**
 * 
 * @return void
 */

function run()
{
    $arrViewData = array();
    $arrViewData['categorias'] = obtenerTodasCategorias();

    renderizar('mantenimientos/categorias', $arrViewData);
}

run();

?>