<?php

require_once "vendor/autoload.php";

//die("<h1>Revisar el archivo libs/paypal.php</h1> <h1>Comentar o eliminar linea 5 despues de agregar las credenciales de sandbox de la cuenta de developer.paypal.com</h1>";

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