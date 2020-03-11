<?php

/**
 * 
 * @return void
 */

 //INCLUIR EL MODELO DE DATOS YA ESTABLECIDO PARA SEGURIDAD EN EL REGISTRO DEL USUARIO
 require_once "models/security/security.model.php"; 

function run()
{
    //Se traen los nombres de los datos de la funcion de Ingresar Nuevo Usuario de security
    $arrViewData = array();
    
    $arrViewData['userName'] = '';
    $arrViewData['userEmail'] = '';
    $arrViewData['timestamp'] = '';
    $arrViewData['password'] = '';
    $arrViewData['passwordCnf'] = ''; 
    $arrViewData['userType'] = 'PUB'; //Tiene acceso a la parte publica

    //libs / Utilities
    //Para poder agregar una js
    addJsRef('public/js/validators.js'); 
    
    renderizar("register", $arrViewData);
}

run();

?>