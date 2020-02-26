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
            //se extrae el codigo y se convierte a su tipo de dato. SOLO EL CODIGO PORQUE CON EL SE BUSCAN LOS DEMAS EN LA BDD
            $arrViewData['ctgcod'] = intval($_GET['ctgcod']); 

            //se guarda la peticion que trae en el arreglo de datos a mostrar
            $arrViewData['mode'] = $_GET['mode']; 
        }

        //Si se escogio una categoria && el modo no es insertar (Porque si es Insertar, los textbox se tienen que mostrar vacios)
        if($arrViewData['ctgcod'] > 0 && $arrViewData['mode']!=='INS')  
        {
            //Se va a buscar a la BDD lo datos de la categoria que se selecciono para mostrarlos
            $arrTempCategoria =  obtenerCategoriaPorCodigo($arrViewData['ctgcod']); 

            //DESDE libs/utilities. Para llenar resultados de un arreglo de origen a uno de destino
            mergeFullArrayTo($arrTempCategoria, $arrViewData); 
        }

        // switch($arrViewData['mode'])
        // {
        //     case 'INS':
        //     break;

        //     case 'UPD':
        //     break;

        //     case 'DEL':
        //     break;

        //     case 'DSP':
        //     break;
        // }

    }  

    // if($_SERVER["REQUEST_METHOD"] === "POST")
    // {
    //     //*********** EN EL CONTROLADOR SE TRABAJAN LOS POST ********************/
    //     if(isset($_POST['btnConfirmar']))
    //     {
    //         //PROBAR SI SE ESTAN ENVIANDO LOS VALORES
    //         //print_r($_POST);
    //         //die();

    //         guardarNuevaCategoria($_POST['ctgdsc'], $_POST['ctgest']);
    //         redirectWithMessage("Guardado Satisfactoriamente", "index.php?page=categorias"); //Funcion por defecto para redirigir con un mensaje
    //         die(); //terminar proceso
    //     }
    // }

    //No importa si es GET o POST siempre va a buscar el titulo para ponerlo
    $arrViewData['modedsc'] = sprintf($arrModeDsc[$arrViewData['mode']], $arrViewData['ctgcod'], $arrViewData['ctgdsc']);

    //Cual esta seleccionada en el Combobox Estado
    $arrViewData['ctgEstACTTrue'] = ($arrViewData['ctgest'] == 'ACT')? "selected": "";
    $arrViewData['ctgEstINATrue'] = ($arrViewData['ctgest'] == 'INA')? "selected": "";

    renderizar("mantenimientos/categoria", $arrViewData);
}

run();

?>