<?php

/**
 * PHP Version 7
 * Controlador de CheckOut
 *
 * @category Controllers_CheckOut_Approved
 * @package  Controllers\CheckOut_Approved
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */

 require_once "models/paypal/paypal.model.php";

/**
 * Controlador cuando paypal manda una aprobación del usuario
 * se debe ahora procesar el pago ejecutandolo y creando la factura
 * 
 * @return void
 */

 function run()
 {
    $arrViewData = array();
    $usuario = $_SESSION['userCode'];

    //Ejecutar el Pago
    $payment = executePaypal();

    //Si se ejecuto correctamente
    if($payment)
    {
        //Si al enviar el usuario y la info del pago se crea la factura correctamente
        if( crearFactura($usuario, $payment->toJSON()) )
        {
            //Mostrar Contador del carrito en 0
            addToContext("cartEntries", 0);

            //Se toman lo datos del pago que da Paypal con formato JSON para poder mostrarlos
            $arrViewData['payment'] = $payment->toJSON();

            //Nombre y Apellido de la persona
            $arrViewData['checkoutTitle'] = $payment->getPayer()->getPayerInfo()->getFirstName()." ".
                                            $payment->getPayer()->getPayerInfo()->getLastName();

            //Descripcion si se desea colocar una
            $arrViewData['checkoutDescription'] = "";

            //Si hay errores
            $arrViewData['error'] = "";

            //Total Pagado
            $arrViewData['amount'] = $payment->getTransactions()[0]->getAmount()->getTotal();
        }
    }
    else
    {
        //Si hay errores
        $arrViewData['error'] = "Error al Procesar el Pago";
    }

    renderizar("retail/paypal/checkoutappr", $arrViewData);
 }

 run();

?>