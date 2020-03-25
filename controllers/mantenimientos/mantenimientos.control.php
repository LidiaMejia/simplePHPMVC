<?php

/**
 * Menu de Mantenimientos
 * 
 * @return void
 */

 function run()
 {
    $arrDataView = array();
    $arrMantenimientos = array();

    //Para Obtener el usuario logueado
    $usuario = $_SESSION["userCode"];

    if (isAuthorized('categorias', $usuario)) 
    {
        $arrMantenimientos[] = array(
            "page" => "categorias",
            "pageDsc"=>"Categorias",
            "ionicon"=> "ios-cog"
        );
    }

    if (isAuthorized('centros_de_costos', $usuario)) 
    {
        $arrMantenimientos[] = array(
            "page" => "centros_de_costos",
            "pageDsc"=>"Centro de Costos",
            "ionicon"=> "cash"
        );
    }

    if (isAuthorized('productos', $usuario)) 
    {
        $arrMantenimientos[] = array(
            "page" => "productos",
            "pageDsc"=>"Productos",
            "ionicon"=> "cube"
        );
    }

    $arrDataView["mantenimientos"] = $arrMantenimientos;
    
    renderizar("mantenimientos/mantenimientos", $arrDataView);
 }

 run();


?>