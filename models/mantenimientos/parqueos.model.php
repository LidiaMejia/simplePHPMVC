<?php

/**
 * 
 * @return array
 */

 require_once "libs/dao.php";

 function todosParqueos()
 {
     $arrParqueos = array();
     $sqlSelect = "select * from parqueos;";  
     return $arrParqueos = obtenerRegistros($sqlSelect);
 }

?>