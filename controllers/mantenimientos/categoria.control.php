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

    /******************* BUSCAMOS DETERMINAR EN QUE MODO ESTAMOS: SI VAMOS A INSERTAR, BORRAR, ACTUALIZAR O VER ************/

    //Descripcion de la accion para poner en el titulo del FORM
    $arrModeDsc = array(
        'INS' => "Crear Nueva Categoría",
        'UPD' => "Actualizando Categoría %s - %s",
        'DEL' => "Eliminando Categoría %s - %s",
        'DSP' => "Mostrando Categoría %s - %s"
    );

    //Inicializando variables. LAS QUE VIENEN DEL FORM (VIEW)
    $arrViewData['ctgcod'] = 0;
    $arrViewData['ctgdsc'] = '';
    $arrViewData['ctgest'] = 'ACT';
    $arrViewData['ctgEstACTTrue'] = '';
    $arrViewData['ctgEstINATrue'] = '';
    $arrViewData['mode'] = 'INS'; //Puede ser INS, UPD, DEL, DSP ---> CRUD //DEPENDE DE LO QUE SE QUIERA HACER CON EL FORM



    /** $_SERVER es DE SOLO LECTURA. Obtenemos la peticion que hace el proceso: GET o POST **/
    if($_SERVER["REQUEST_METHOD"] === "GET") 
    {
        //Si existe el mode, si trae algo
        if(isset($_GET['mode']))
        {
            //se guarda la peticion que trae en el arreglo de datos a mostrar
            $arrViewData['mode'] = $_GET['mode']; 

            //se extrae el codigo y se convierte a su tipo de dato. SOLO EL CODIGO PORQUE CON EL SE BUSCAN LOS DEMAS EN LA BDD
            $arrViewData['ctgcod'] = intval($_GET['ctgcod']); 
        }

        //Si se escogio una categoria && el modo no es insertar (Porque si es Insertar, los textbox se tienen que mostrar vacios)
        if($arrViewData['ctgcod'] > 0 && $arrViewData['mode']!=='INS')  
        {
            //Se va a buscar a la BDD lo datos de la categoria que se selecciono para mostrarlos
            $arrTempCategoria =  obtenerCategoriaPorCodigo($arrViewData['ctgcod']); 

            //DESDE libs/utilities. Para llenar resultados de un arreglo de origen a uno de destino
            mergeFullArrayTo($arrTempCategoria, $arrViewData); 
        }

    }  

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        //Se refresca cada dato con lo que viene en el POST
        $arrViewData['ctgcod'] = intval($_POST['ctgcod']);
        $arrViewData['ctgdsc'] = $_POST['ctgdsc'];
        $arrViewData['ctgest'] = $_POST['ctgest'];
        $arrViewData['mode'] = $_POST['mode']; 

        //Se busca con que modo se esta trabajando y se buscan las funciones en el modelo
        switch($arrViewData['mode']) 
        {
            case 'INS':
                guardarNuevaCategoria($arrViewData['ctgdsc'], $arrViewData['ctgest']);
                redirectWithMessage("Guardado Satisfactoriamente", "index.php?page=categorias"); //Funcion por defecto para redirigir con un mensaje
                die(); //terminar proceso
            //break; Aqui no se ocupa porque ya hay un die(); 

            case 'UPD':
                actualizarCategoria($arrViewData['ctgcod'], $arrViewData['ctgdsc'], $arrViewData['ctgest']);
                redirectWithMessage("Actualizado Satisfactoriamente", "index.php?page=categorias");
                die();

            case 'DEL':
                eliminarCategoria($arrViewData['ctgcod']);
                redirectWithMessage("Eliminada Satisfactoriamente", "index.php?page=categorias");
                die();

            case 'DSP':
                redirectToUrl("index.php?page=categorias");   
            break;
        }

        //PROBAR SI SE ESTAN ENVIANDO LOS VALORES
        //print_r($_POST);
        //die();         
    }


    //No importa si es GET o POST siempre va a buscar el titulo para ponerlo
    $arrViewData['modedsc'] = sprintf($arrModeDsc[$arrViewData['mode']], $arrViewData['ctgcod'], $arrViewData['ctgdsc']);

    //Cual esta seleccionada en el Combobox Estado segun la BDD
    $arrViewData['ctgEstACTTrue'] = ($arrViewData['ctgest'] == 'ACT')? "selected": "";
    $arrViewData['ctgEstINATrue'] = ($arrViewData['ctgest'] == 'INA')? "selected": "";

    renderizar("mantenimientos/categoria", $arrViewData);
}

run();

?>