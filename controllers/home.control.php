<?php
/* Home Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */

 require_once "models/mantenimientos/productos.model.php";
 
 function run()
 {
    $arrViewData = array();

    $arrViewData["productos"] = productoCatalogo(); //Ya no se muestran todos los productos, solo los permitidos y con stock actualizado

    renderizar("home", $arrViewData); 
 }

 run();

?>
