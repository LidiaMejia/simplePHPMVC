<?php

/**
 * PHP Version 7
 * Controlador de CheckOut
 *
 * @category Controllers_CheckOut
 * @package  Controllers\CheckOut
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */

// Sección de requires
require_once "models/paypal/paypal.model.php";

/**
 * 
 * @return void
 */

function run()
{
    $arrViewData = array();

    //Saca la informacion de la carretilla autenticada del usuario 
    //para mostrarla y que pueda hacer una ultima modificacion si lo desea 
    $usuario = $_SESSION['userCode'];

    $arrViewData = getAuthCartDetail($usuario);

    //Si se presiona el boton de "Pagar con Paypal" en el checkout
    if(isset($_POST["btnSubmit"]))
    {
        //Se crea la transaccion en Paypal con los productos a solicitar pago
        $paypalReturn = createPaypalTransaction(0, $arrViewData["products"]);

        if($paypalReturn)
        {
            //Si se completo correctamente redirecciona a checkoutapr
            redirectToUrl($paypalReturn);
        }

        //Se guardan los datos del pago
        $arrViewData['returnData'] = $paypalReturn; 

    }

    //Resetea el tiempo de la carretilla con la fecha de hoy
    resetCartTime($usuario); 

    renderizar("retail/paypal/checkout", $arrViewData);
}

run();

?>