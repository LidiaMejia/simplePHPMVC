<?php

/**
 * Controlador Tabla Productos
 * 
 * @return void
 */

 require_once "models/mantenimientos/productos.model.php";

function run()
{
    $arrViewData = array();

    $arrViewData["productos"] = todosLosProductos();

    renderizar("mantenimientos/productos", $arrViewData);
}

run();

?>