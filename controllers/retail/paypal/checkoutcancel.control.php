<?php

/**
 * PHP Version 7
 * Controlador de CheckOutCancel
 *
 * @category Controllers_CheckOutCancel
 * @package  Controllers\CheckOutCancel
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */

/**
 * Cuando Paypal Envia una alerta de cancelación.
 *
 * @return void
 */

function run()
{
    $arrViewData = array();

    renderizar("retail/paypal/checkoutcancel", $arrViewData);
}

run();

?>