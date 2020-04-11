<?php

/**
 * PHP Version 7
 * Controlador de Controlador
 *
 * @category Controllers_Middleware_Cart
 * @package  Controllers\Middleware_Cart
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
 * Se busca identificar al usuario, si existe una carretilla anonima para pasarla a autenticada cuando se loguee
 * y controlar el contador de productos para que aparezca en la imagen del carrito
 * 
 * @return void
 */

 function runCartMW()
 {
    $cartEntries = 0;
    $cartAnonUniqueID = '';

    //Si existe el Unique user anonimo en la sesion, lo guardo
    if(isset($_SESSION["cart_anon_uid"]))
    {
        $cartAnonUniqueID = $_SESSION["cart_anon_uid"];
    }

    //Si se loguea. Verificar
    if(mw_estaLogueado())
    {
        //Guardar usuario
        $usuario = $_SESSION["userLogged"];

        // Si existe un $carNonUniqueID signigica que lleno una carretilla anonima
        //    Se obtiene la cantidad de productos que hay en la carretilla anonima
        //    Sacamos si tiene productos
        //    Si tiene productos pasarlos a la carretilla autenticada
        //    Borrar la carretilla no auntenticada ?????
        //    eliminar el código de sesion anonima

        if($cartAnonUniqueID !== '')
        {
            $tempAnonCartCant = getCartProductsData($cartAnonUniqueID);

            if($tempAnonCartCant > 0)
            {
                passAnonCartToCart($cartAnonUniqueID, $usuario);
                unset($_SESSION["cart_anon_uid"]);
            }
        }

        //Obtener Cantidad de la carretilla autenticada
        $cartEntries = getCartProducts($usuario);
    }
    // sino esta logueado
    //     extraer la cantidad de productos de la carretilla anonima.
    // endif
    else
    {
        if($cartAnonUniqueID !== '')
        {
            $cartEntries = getCartProductsData($cartAnonUniqueID);
        }
    }

    //Actualizar Contador
    addToContext("cartEntries", $cartEntries);
 }

 runCartMW(); 

?>