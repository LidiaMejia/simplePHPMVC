<?php

/**
 * Modelo Tabla Productos
 * 
 * @return array
 */

 require_once "libs/dao.php";

 function todosLosProductos()
 {
     $sqlSelect = "SELECT * FROM productos;";

     return obtenerRegistros($sqlSelect);
 }

 function obtenerUnProducto($codprd)
 {
     $sqlSelect = "SELECT * FROM productos WHERE codprd = %d;";

     return obtenerUnRegistro(
        sprintf($sqlSelect, $codprd)
     );
 }

 function insertProducto($dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $urlprd, $urlthbprd, $estprd)
 {
     $sqlInsert = "INSERT INTO productos (dscprd, sdscprd, ldscprd, skuprd, bcdprd, stkprd, typprd, prcprd, urlprd, urlthbprd, estprd) 
                   VALUES ('%s', '%s', '%s', '%s', '%s', %d, '%s', %lf, '%s', '%s', '%s');";
    
     $isOk = ejecutarNonQuery(
        sprintf($sqlInsert, $dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $urlprd, $urlthbprd, $estprd)
     ); 

     return getLastInserId();
 }

 function updateProducto($dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $urlprd, $urlthbprd, $estprd, $codprd)
 {
     $sqlUpdate = "UPDATE productos SET dscprd = '%s', sdscprd = '%s', ldscprd = '%s', skuprd = '%s', bcdprd = '%s', stkprd = %d,
                   typprd = '%s', prcprd = %lf, urlprd = '%s', urlthbprd = '%s', estprd = '%s' WHERE codprd = %d;";

     return ejecutarNonQuery(
        sprintf($sqlUpdate, $dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $urlprd, $urlthbprd, $estprd, $codprd)
     ); 
 }

 function deleteProducto($codprd)
 {
     $sqlDelete = "DELETE FROM productos WHERE codprd = %d;";

     return ejecutarNonQuery(
         sprintf($sqlDelete, $codprd)
     );
 }

?>