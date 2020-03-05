<?php

/**
 * 
 * 
 * @return void
 */

 require_once "models/mantenimientos/parqueos.model.php";

 function run()
 {
     $arrViewData = array();
     $arrViewData['parqueos'] = todosParqueos(); 

     renderizar("mantenimientos/parqueos", $arrViewData);
 }

 run();


?>