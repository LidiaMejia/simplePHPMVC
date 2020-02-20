<?php
/**
*
*Run function Ejecuta el controlador
*@return void
*
*/


  function run()
  {
    //ARREGLO DE DATOS QUE SE VAN A MOSTRAR
    $arrViewData = array();
    $arrViewData['nombre'] =  "Lidia";
    $arrViewData['cuenta'] =  "1502199600657";
    $arrViewData['email'] =  "lidiamejia29@yahoo.com";  

    //*AQUI SE RENDERIZA LA VISTA CON LOS DATOS. SE MANDA LA URL
    renderizar("ficha", $arrViewData);
  }

  run();


?>