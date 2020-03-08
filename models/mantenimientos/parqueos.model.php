<?php

/**
 * 
 * @return array
 */

 require_once "libs/dao.php";

 function todosParqueos()
 {
     $arrParqueos = array();
     $sqlSelect = "SELECT * FROM parqueos;";

     return $arrParqueos = obtenerRegistros($sqlSelect);
 }

 function obtenerUnParqueo($parqueoId)
 {
     $sqlSelect = "SELECT * FROM parqueos WHERE parqueoId = %d;";

     return obtenerUnRegistro(
        sprintf($sqlSelect, $parqueoId)
     );
 }

 function insertarParqueo($parqueoEst, $parqueoLot, $parqueoTip)
 {
     $sqlInsert = "INSERT INTO parqueos (parqueoEst, parqueoLot, parqueoTip) VALUES ('%s', '%s', '%s');";
     $isOk = ejecutarNonQuery(
        sprintf($sqlInsert, $parqueoEst, $parqueoLot, $parqueoTip)
     );

     return getLastInserId();
 }

 function actualizarParqueo($parqueoId, $parqueoEst, $parqueoLot, $parqueoTip)
 {
     $sqlUpdate = "UPDATE parqueos SET parqueoEst = '%s', parqueoLot = '%s', parqueoTip = '%s' WHERE parqueoId = %d;";

     return ejecutarNonQuery(
        sprintf($sqlUpdate, $parqueoEst, $parqueoLot, $parqueoTip, $parqueoId)
     );
 }

 function eliminarParqueo($parqueoId)
 {
     $sqlDelete = "DELETE FROM parqueos WHERE parqueoId = %d;";

     return ejecutarNonQuery(
        sprintf($sqlDelete, $parqueoId)
     );
 }

?>