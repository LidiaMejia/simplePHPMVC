<?php

/**
 * PHP Version 7
 * Controlador de CartAnon
 *
 * @category Controllers_CartAnon
 * @package  Controllers\CartAnon
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
 * Corre el Controlador de CartAnon
 *
 * @return void
 */

 function run()
 {
    //Saber si existe el usuario anonimo o se tiene que crear, para mostrar su carretilla

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

    $arrViewData = array();
    $arrViewData = getAnonCartDetail($cartAnonUniqueID); //Se devuelve el array $arrProductosFinal["products"][]

    renderizar("retail/cartauth", $arrViewData); //Solo hay una vista para las dos carretillas.
 }  

 run();

?>