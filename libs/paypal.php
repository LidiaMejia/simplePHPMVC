<?php

/**
 * PHP Version 7
 * Controlador de Paypal
 *
 * @category Controllers_Paypal
 * @package  Controllers\Paypal
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */

// Sección de requires
require_once "vendor/autoload.php";

/*die("<h1>Revisar el archivo libs/paypal.php</h1> 
       <h1>Comentar o eliminar lineas 20-22 despues de agregar las credenciales de sandbox de la cuenta de developer.paypal.com</h1>
       <h2><a href=\"index.php?page=dashboard\">Regresar</a></h2>");*/

/**
 * Retorna el API Context de Paypal
 * 
 * @return void
 */

 function getApiContext()
 {
     $apiContext = new \PayPal\Rest\ApiContext(
         new \PayPal\Auth\OAuthTokenCredential(
             'AYYSSUYc5-6Lv7rPa1Vk-5pJoj7bQF7i2XcSX0-9CooUZdeVqZ2jgbWuwBGFFbZ8HhInXP3hTEFJR7EM', //ClientID
             'EJv9qYD9bgxCswKcyTGFMbY_5WYLbFPZB9eZAAEHaGCoc1yVe1nh6GeyXCW5d2R4McAFb8I8aYjujOm-'  //ClientSecret
         )
     ); 

     return $apiContext;
 }

?>