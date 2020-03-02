<?php

/**
 * Controlador de Libros
 * 
 * @return void
 */

 require_once "models/mantenimientos/libros.model.php";

 function run()
 {
     $arrViewData = array();

     $arrViewData['libros'] = todosLibros();

     renderizar("mantenimientos/libros", $arrViewData);
 }

 run();

?>