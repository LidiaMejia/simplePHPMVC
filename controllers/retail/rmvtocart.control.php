<?php

/**
 * PHP Version 7
 * Controlador de Controlador
 *
 * @category Controllers_RmvToCart
 * @package  Controllers\Controllers_RmvToCart
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

    // Si se da clic al boton de quitar (POST) y se recibe un codigo de producto en la URL (GET). AMBOS METODOS EN UNO
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['codprd']))
    {
        //Se obtiene el producto del GET, la cantidad en este esquema es 1, y se buscan todos los datos de ese producto
        $codprd = intval($_GET['codprd']);
        $cantidad = 1;
        $producto = obtenerUnProducto($codprd);

        //Si no existe el producto seleccionado, se devuelve el array con el mensaje como objeto json
        if(count($producto) <=0)
        {
            $resultArray['msg'] = "No se encontró producto";
            header('Content-Type: application/json');
            echo json_encode($resultArray);
            die();
        }

        //Si existe se procede a obtener el precio de ese producto
        $precio = $producto['prcprd'];

        //En controllers/mw/verificar.mw.php esta la funcion para saber si esta logueado o no. Asi sabemos en que carretilla quitar el producto
        if(mw_estaLogueado())
        {
            //Quitar de Carretilla Autenticada

            $resultArray['msg'] = "Eliminando a Carretilla Autenticada";
            $usuario = $_SESSION["userCode"]; //Tambien en verificar esta guardado en la sesion el usuario logueado
            rmvCartAuth($codprd, $usuario, $cantidad);
            $resultArray["cartAmount"] = 1; //getCartProducts($usuario);
        }
        else
        {
            //Quitar de Carretilla Anonima

            //ID Unico de Usuario. Si ya esta en la sesion (ya compro algo) se toma de ahi, sino se crea random
            $cartAnonUniqueID = '';

            if(isset($_SESSION["cart_anon_uid"]))
            {
                $cartAnonUniqueID = $_SESSION["cart_anon_uid"];
            }

            if($cartAnonUniqueID === '')
            {
                $cartAnonUniqueID = time() . random_int(1000,9999);
            }

            $_SESSION["cart_anon_uid"] = $cartAnonUniqueID; //*Tambien en verificar hay que crear esta sesion

            //Se agrega a la carretilla anonima y se obtiene la cantidad de productos que hay en la carretilla
            $resultArray['msg'] = "Eliminando a Carretilla Anónima";
            rmvCartAnon($codprd, $cartAnonUniqueID, $cantidad);
            $resultArray['cartAmount'] = 1; //getCartProductsData($cartAnonUniqueID); 
        }
    }
    else
    {
        //Si no hay POST ni GET
        $resultArray['msg'] = "Está tratando de hacer algo incorrecto";
    }

    //Se crea el objeto json del arreglo y se muestra en console
    header('Content-Type: application/json');
    echo json_encode($resultArray);
    die();
 }

 run();

?>