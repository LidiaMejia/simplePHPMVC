<?php

/**
 * PHP Version 7
 * Controlador de Controlador
 *
 * @category Controllers_AddToCart
 * @package  Controllers\Controllers_AddToCart
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */

 // Sección de requires
require_once "models/mantenimientos/productos.model.php";

/**
 * Corre el Controlador
 *
 * @return void
 */

 function run()
 {
    $resultArray = array();

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        if(mw_estaLogueado())
        {
            //Eliminar Carretilla Autenticada

            $resultArray["msg"] = "Eliminando toda la Carretilla Autenticada";
            $usuario = $_SESSION["userCode"];
            deleteCartAuth($usuario);
            $resultArray["cartAmount"] = 1;
        }
        else
        {
            //Eliminar Carretilla Anonima 

            $cartAnonUniqueID = '';

            if(isset($_SESSION["cart_anon_uid"]))
            {
                $cartAnonUniqueID = $_SESSION["cart_anon_uid"];
            }
            
            if($cartAnonUniqueID === '')
            {
                $cartAnonUniqueID = time() . random_int(1000, 9999);
            }

            $_SESSION["cart_anon_uid"] = $cartAnonUniqueID;

            $resultArray["msg"] = "Eliminando toda la Carretilla Anonima";
            deleteCartUnAuth($cartAnonUniqueID);
            $resultArray["cartAmount"] = 1;
        }
    }
    else
    {
        $resultArray["msg"] = "Está tratando de hacer algo incorrecto";
    }

    header('Content-Type: application/json');
    echo json_encode($resultArray);
    die();
 }

 run();

?>