<?php

/**
 * PHP Version 7
 * Controlador de Controlador
 *
 * @category Controllers_Home
 * @package  Controllers\Home
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com 
 */

/**
 * 
 * @return void
 */

 require_once "models/mantenimientos/productos.model.php";
 
 function run()
 {
    $arrViewData = array();

    $arrViewData["productos"] = productoCatalogo(); //Ya no se muestran todos los productos, solo los permitidos y con stock actualizado

    renderizar("home", $arrViewData); 
 }

 run();

?>
