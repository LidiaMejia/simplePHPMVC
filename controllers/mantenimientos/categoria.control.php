<?php

require_once 'models/mantenimientos/categorias.model.php'; 

/**
 * Controlador de Vista Formulario de Nueva Categoria
 * 
 * @return void
 */

function run()
{
    $arrViewData = array();

    //*********** EN EL CONTROLADOR SE TRABAJAN LOS POST ********************/
    if(isset($_POST['btnConfirmar']))
    {
        //PROBAR SI SE ESTAN ENVIANDO LOS VALORES
        //print_r($_POST);
        //die();

        guardarNuevaCategoria($_POST['ctgdsc'], $_POST['ctgest']);
        redirectWithMessage("Guardado Satisfactoriamente", "index.php?page=categorias"); //Funcion por defecto para redirigir con un mensaje
        die(); //terminar proceso
    }

    renderizar("mantenimientos/categoria", $arrViewData);
}

run();

?>