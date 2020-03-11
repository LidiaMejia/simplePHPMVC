<?php

/**
 * 
 * 
 * @return array
 */

 require_once "libs/dao.php";

 function obtenerTodosCC()
 {
     $sqlSelect = "SELECT * FROM centroscostos;";

     return obtenerRegistros($sqlSelect);
 }

 function obtenerUnCC($ccid)
 {
     $sqlSelect = "SELECT * FROM centroscostos WHERE ccid = %d;";

     return obtenerUnRegistro(
        sprintf($sqlSelect, $ccid)
     );
 }

 function insertarCC($ccdsc, $ccest, $cctipo)
 {
     $sqlInsert = "INSERT INTO centroscostos (ccdsc, ccest, cctipo) VALUES ('%s', '%s', '%s');";
     $isOK = ejecutarNonQuery(
        sprintf($sqlInsert, $ccdsc, $ccest, $cctipo)
     );

     return getLastInserId(); 
 }

 function editarCC($ccid, $ccdsc, $ccest, $cctipo)
 {
     $sqlUpdate = "UPDATE centroscostos SET ccdsc = '%s', ccest = '%s', cctipo = '%s' WHERE ccid = %d;";

     return ejecutarNonQuery(
        sprintf($sqlUpdate, $ccdsc, $ccest, $cctipo, $ccid)
     );
 }

 function eliminarCC($ccid)
 {
     $sqlDelete = "DELETE FROM centroscostos WHERE ccid = %d;";

     return ejecutarNonQuery(
        sprintf($sqlDelete, $ccid)
     );
 }

?>