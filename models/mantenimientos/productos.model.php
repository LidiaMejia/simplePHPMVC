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

 //Guardar Imagen para el Producto (Ambas Imagenes)
 function setImageProducto($url, $codprd, $type="PRT")
 {
    $sqlUpdatePRT = "UPDATE productos SET urlprd = '%s' WHERE codprd = %d;";
    $sqlUpdateTHB = "UPDATE productos SET urlthbprd = '%s' WHERE codprd = %d;";

    $sqlUpdate = ($type === "PRT")? $sqlUpdatePRT : $sqlUpdateTHB;

    return ejecutarNonQuery(
        sprintf($sqlUpdate, $url, $codprd)
    );
 }

 /****************************************  Catalogo  *******************************************************/

 //Mostrar solo los productos que se pueden vender (Activos y Descontinuados) y su Stock Disponible (Real - Reservado)
 function productoCatalogo()
 {
     //Obtener los datos a mostrar de los productos disponibles para vender
     $sqlSelect = "SELECT codprd, dscprd, skuprd, stkprd, prcprd, urlthbprd FROM productos WHERE estprd in('ACT', 'DSC');";
     $tempProducto = obtenerRegistros($sqlSelect);

     //Establecer en $assocProducto la llave primaria codprd para cada registro, asi se accede a cada uno por su llave sin tener que estar recorriendo el arreglo
     $assocProducto = array();

     foreach($tempProducto as $producto)
     {
         $assocProducto[$producto['codprd']] = $producto;

         //Si no hay imagen, se coloca la de "No hay imagen disponible"
         if(preg_match('/^\s*$/', $producto["urlthbprd"]))
         {
             $assocProducto[$producto['codprd']['urlthbprd']] = "public/imgs/noprodthb.phg";
         }
     }

     //Cuanto tiempo se puede mantener en reserva (h, m, s). En este caso son 6 horas, si fuera un dia seria: 1 * 24 * 60 * 60
     $timeDelta = 6 * 60 * 60;

     /*Buscar en todas las carretillas el stock reservado, 
       es decir donde la diferencia entre la fecha de hoy y la de reserva en segundos sea menor o igual al tiempo de reserva permitido.*/
     $sqlSelectReserved = "SELECT codprd, sum(crrctd) AS reserved FROM carretilla
                           WHERE TIME_TO_SEC( TIMEDIFF(now(), crrfching) ) <= %d
                           GROUP BY codprd;";

     $arrReserved = obtenerRegistros(
        sprintf($sqlSelectReserved, $timeDelta)
     );

     //Recorrer los productos reservados para saber cuales de los disponibles para vender estan reservados; y asi actualizar su Stock Disponible
     foreach($arrReserved as $reserved)
     {
         if( isset($assocProducto[$reserved['codprd']]) )
         {
            $assocProducto[$reserved['codprd']]['stkprd'] = $assocProducto[$reserved['codprd']]['stkprd'] - $reserved['reserved'];
         }
     }

     return $assocProducto; 
 }

?>