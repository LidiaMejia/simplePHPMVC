<?php

/**
 * PHP Version 7
 * Modelo de Datos para modelo
 *
 * @category Data_Model
 * @package  Models/Productos
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS: 1.0.0
 *
 * @link http://url.com
 */

 require_once "libs/dao.php";

 /*----------------------------------------------------------------
 Constantes como funciones
-----------------------------------------------------------------*/

/**
 * Obtiene la Delta para Carretilla Autenticada
 *
 * @return integer
 */
function getAuthTimeDelta()
{
    return 21600; // 6 * 60 * 60; // horas * minutos * segundo
    // No puede ser mayor a 34 días
}

/**
 * Obtiene la Delta para Carretilla Anónima
 *
 * @return integer
 */
function getUnAuthTimeDelta()
{
    return 600; // 10 * 60; //h , m, s
    // No puede ser mayor a 34 días
}


 /*----------------------------------------------------------------
Funciones
-----------------------------------------------------------------*/

/**
 * Obtiene todos los productos
 *
 * @return array Arreglo con los Productos
 */
 function todosLosProductos()
 {
     $sqlSelect = "SELECT * FROM productos;";

     return obtenerRegistros($sqlSelect);
 }


/**
 * Obtiene los Productos para el catálogo.
 * Mostrar solo los productos que se pueden vender (Activos y Descontinuados) y su Stock Disponible (Real - Reservado)
 * Tanto en Autenticado como en Anonimo
 *
 * @return array Arreglo de Productos
 */
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
             $assocProducto[$producto['codprd']['urlthbprd']] = "public/imgs/noprodthb.png";
         }
     }

     ////////QUITAR LOS RESERVADOS AUTENTICADOS

     //Cuanto tiempo se puede mantener en reserva (h, m, s). En este caso son 6 horas, si fuera un dia seria: 1 * 24 * 60 * 60
     $timeDelta =  getAuthTimeDelta(); // 6 * 60 * 60

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


     ////////QUITAR LOS RESERVADOS ANONIMOS

     $timeDelta = getUnAuthTimeDelta(); //10 * 6

     $sqlSelectReserved = "SELECT codprd, sum(crrctd) as reserved FROM carretillaanon
                           WHERE TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d
                           GROUP BY codprd;";

     $arrReserved = obtenerRegistros(
        sprintf($sqlSelectReserved, $timeDelta)
     );

     foreach($arrReserved as $reserved)
     {
         if( isset($assocProducto[$reserved['codprd']]) )
         {
            $assocProducto[$reserved['codprd']]['stkprd'] = $assocProducto[$reserved['codprd']]['stkprd'] - $reserved['reserved'];
         }
     }

     return $assocProducto; 
 }




 /**
 * Obtiene un producto
 *
 * @param integer $codprd Código de Producto
 *
 * @return void
 */
 function obtenerUnProducto($codprd)
 {
     $sqlSelect = "SELECT * FROM productos WHERE codprd = %d;";

     return obtenerUnRegistro(
        sprintf($sqlSelect, $codprd)
     );
 }

 /**
 * Obtiene solo un registro del catalogo con los datos de Stock Disponible
 *
 * @param integer $codprd Código del Producto
 *
 * @return void Arreglo del Producto
 */
function getOneProductoCatalogo($codprd)
{
    $sqlSelect = "SELECT codprd, dscprd, stkprd, skuprd, urlthbprd, prcprd FROM productos WHERE codprd = %d;";

    $tempProducto = obtenerRegistros(
        sprintf($sqlSelect, $codprd)
    );

    $assocProducto = array();

     foreach($tempProducto as $producto)
     {
         $assocProducto[$producto['codprd']] = $producto;

         //Si no hay imagen, se coloca la de "No hay imagen disponible"
         if(preg_match('/^\s*$/', $producto["urlthbprd"]))
         {
             $assocProducto[$producto['codprd']['urlthbprd']] = "public/imgs/noprodthb.png";
         }
     }

     ////////QUITAR LOS RESERVADOS AUTENTICADOS DE ESE PRODUCTO

     $timeDelta =  getAuthTimeDelta();

     $sqlSelectReserved = "SELECT codprd, sum(crrctd) AS reserved FROM carretilla
                           WHERE TIME_TO_SEC( TIMEDIFF(now(), crrfching) ) <= %d AND codprd = %d
                           GROUP BY codprd;";

     $arrReserved = obtenerRegistros(
        sprintf($sqlSelectReserved, $timeDelta, $codprd)
     );

     foreach($arrReserved as $reserved)
     {
         if( isset($assocProducto[$reserved['codprd']]) )
         {
            $assocProducto[$reserved['codprd']]['stkprd'] = $assocProducto[$reserved['codprd']]['stkprd'] - $reserved['reserved'];
         }
     }


     ////////QUITAR LOS RESERVADOS ANONIMOS DE ESE PRODUCTO

     $timeDelta = getUnAuthTimeDelta();

     $sqlSelectReserved = "SELECT codprd, sum(crrctd) as reserved FROM carretillaanon
                           WHERE TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d AND codprd = %d
                           GROUP BY codprd;";

     $arrReserved = obtenerRegistros(
        sprintf($sqlSelectReserved, $timeDelta, $codprd)
     );

     foreach($arrReserved as $reserved)
     {
         if( isset($assocProducto[$reserved['codprd']]) )
         {
            $assocProducto[$reserved['codprd']]['stkprd'] = $assocProducto[$reserved['codprd']]['stkprd'] - $reserved['reserved'];
         }
     }

     //Si existe el registro se devuelve, sino se manda un arreglo vacio
     if(count($assocProducto))
     {
         return $assocProducto[$codprd];
     }
     else
     {
         return array();
     }
}



 /**
 * Creando un nuevo Producto
 *
 * @param string  $dscprd    Descripción Comercial
 * @param string  $sdscprd   Descripción Corta
 * @param string  $ldscprd   Descripción Larga
 * @param string  $skuprd    Código de Producto
 * @param string  $bcdprd    Código de Barra
 * @param integer $stkprd    Stock del Producto
 * @param string  $typprd    Tipo de Producto
 * @param double  $prcprd    Precio del Producto
 * @param string  $urlprd    Url de Imagen de Portada
 * @param string  $urlthbprd Url de Imagen de Catálogo
 * @param string  $estprd    Estado de Producto
 *
 * @return integer Codigo del producto agregado
 */
 function insertProducto($dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $urlprd, $urlthbprd, $estprd)
 {
     $sqlInsert = "INSERT INTO productos (dscprd, sdscprd, ldscprd, skuprd, bcdprd, stkprd, typprd, prcprd, urlprd, urlthbprd, estprd) 
                   VALUES ('%s', '%s', '%s', '%s', '%s', %d, '%s', %f, '%s', '%s', '%s');";
    
     $isOk = ejecutarNonQuery(
        sprintf($sqlInsert, $dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $urlprd, $urlthbprd, $estprd)
     ); 

     return getLastInserId();
 }




/**
 * Actualizar Datos del Productos
 *
 * @param string  $dscprd    Descripción Comercial
 * @param string  $sdscprd   Descripción Corta
 * @param string  $ldscprd   Descripción Larga
 * @param string  $skuprd    Código de Producto
 * @param string  $bcdprd    Código de Barra
 * @param integer $stkprd    Inventario de Producto
 * @param string  $typprd    Tipo de Producto
 * @param double  $prcprd    Precio del Producto
 * @param string  $urlprd    Imagen de Portada
 * @param string  $urlthbprd Imágen de Catálogo
 * @param string  $estprd    Estado del Producto
 * @param integer $codprd    Código del Producto
 *
 * @return integer Registros Modificados
 */
 function updateProducto($dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $urlprd, $urlthbprd, $estprd, $codprd)
 {
     $sqlUpdate = "UPDATE productos SET dscprd = '%s', sdscprd = '%s', ldscprd = '%s', skuprd = '%s', bcdprd = '%s', stkprd = %d,
                   typprd = '%s', prcprd = %f, urlprd = '%s', urlthbprd = '%s', estprd = '%s' WHERE codprd = %d;";

     return ejecutarNonQuery(
        sprintf($sqlUpdate, $dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $urlprd, $urlthbprd, $estprd, $codprd)
     ); 
 }




 /**
 * Cambia la Url de la Imagen del producto
 *
 * @param string  $url    URl del archivo ya sea local o absoluta
 * @param integer $codprd Código del Producto
 * @param string  $type   PRT : Imagen de portada, THB : Imagen Catálogo
 *
 * @return integer Registros Afectados
 */
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




 /**
 * Elimina el Producto de la Tabla
 *
 * @param integer $codprd Codigo del producto
 *
 * @return integer Registro Afectados
 */
 function deleteProducto($codprd)
 {
     $sqlDelete = "DELETE FROM productos WHERE codprd = %d;";

     return ejecutarNonQuery(
         sprintf($sqlDelete, $codprd)
     );
 }



 /*----------------------------------------------------------------
 Métodos para la Carretilla
-----------------------------------------------------------------*/
/**
 * Agregar un producto a la carretilla anonima
 *
 * @param integer $codprod    Codigo de Producto
 * @param string  $uniqueUser Codigo de Identificacion anonima
 * @param integer $cantidad   Cantidad de Producto
 * @param float   $precio     Precio del Producto
 *
 * @return void
 */
 function addToCartAnon($codprd, $uniqueUser, $cantidad, $precio)
 {
    //Datos del producto a comprar con su Stock Disponible actualizado
    $productCart = getOneProductoCatalogo($codprd);

    //Si hay producto
    if(count($productCart))
    {
        //Se verifica si el stock disponible es mayor o igual a la cantidad solicitada. Si es asi se agrega
        if($productCart['stkprd'] >= $cantidad)
        {
            $sqlInsert = "INSERT INTO carretillaanon (anoncod, codprd, crrctd, crrprc, crrfching)
            VALUES ('%s', %d, %d, %f, now()) ON DUPLICATE KEY UPDATE crrctd = crrctd + VALUES(crrctd), crrfching = now();";

            return ejecutarNonQuery(
                sprintf($sqlInsert, $uniqueUser, $codprd, $cantidad, $precio)
            );
        }
    }

    return 0;
 }


 /**
 * Agregar un producto a la carretilla autenticada
 *
 * @param integer $codprod  Codigo de Producto
 * @param integer $usuario  Codigo de Identificacion anonima
 * @param integer $cantidad Cantidad de Producto
 * @param float   $precio   Precio del Producto
 *
 * @return void
 */
function addToCartAuth($codprod, $usuario, $cantidad, $precio)
{
    $productoCart = getOneProductoCatalogo($codprod);
    error_log(json_encode($productoCart)); //Log de compra autorizada

    if (count($productoCart)) 
    {
        if ($productoCart["stkprd"] >= $cantidad) 
        {
            $sqlins = "INSERT INTO `carretilla` (`usercod`, `codprd`, `crrctd`, `crrprc`, `crrfching`)
            VALUES (%d, %d, %d, %f, now()) ON DUPLICATE KEY UPDATE crrctd = crrctd + VALUES(crrctd), crrfching = now();";

            return ejecutarNonQuery(
                sprintf($sqlins, $usuario, $codprod, $cantidad, $precio)
            );
        }
    }

    return 0;
}



/**
 * Elimina de la carretilla anonima un producto
 *
 * @param integer $codprod    Código del Producto
 * @param string  $uniqueUser Codigo de Usuario Anonimo
 * @param integer $cantidad   Cantidad a reducir
 *
 * @return integer Registro afectados
 */
function rmvCartAnon($codprod, $uniqueUser, $cantidad)
{
    $productoCart = array();

    //Se obtiene todo lo que hay en la carretilla de ese producto para ese usuario
    $sqlSel = "SELECT * FROM carretillaanon WHERE anoncod = '%s' AND codprd = %d;";

    $productoCart = obtenerUnRegistro(
        sprintf($sqlSel, $uniqueUser, $codprod)
    );

    if (count($productoCart)) 
    {
        //Se guarda la nueva cantidad
        $newCantidad = $productoCart["crrctd"] - $cantidad;

        //Si queda todavia cantidad de ese producto en la carretilla
        if ($productoCart["crrctd"] - $cantidad > 0) 
        {
            //Solo se actualiza
            $sqlupd = "UPDATE carretillaanon SET crrctd = %d, crrfching = now()
                       WHERE anoncod = '%s' AND codprd = %d;";

            return ejecutarNonQuery(
                sprintf($sqlupd, $newCantidad, $uniqueUser, $codprod)
            );
        } 
        else 
        {
            //Sino se elimina el registro del producto
            $sqldel = "DELETE FROM carretillaanon WHERE anoncod = '%s' AND codprd = %d;";

            return ejecutarNonQuery(
                sprintf($sqldel, $uniqueUser, $codprod)
            );
        }
    }

    return 0;
}


/**
 * Elimina de la carretilla un producto
 *
 * @param integer $codprod  Código del Producto
 * @param integer $usuario  Codigo de Usuario Autenticado
 * @param integer $cantidad Cantidad a reducir
 *
 * @return integer Registro afectados
 */
function rmvCartAuth($codprod, $usuario, $cantidad)
{
    $productoCart = array();

    $sqlSel = "SELECT * FROM carretilla WHERE usercod = %d AND codprd = %d;";

    $productoCart = obtenerUnRegistro(
        sprintf($sqlSel, $usuario, $codprod)
    );

    if (count($productoCart)) 
    {
        $newContidad = $productoCart["crrctd"] - $cantidad;

        if ($newContidad > 0) 
        {
            //Solo se actualiza
            $sqlupd = "UPDATE carretilla SET crrctd = %d, crrfching = now()
                       WHERE usercod = %d AND codprd = %d;";

            return ejecutarNonQuery(
                sprintf($sqlupd, $newContidad, $usuario, $codprod)
            );
        } 
        else 
        {
            $sqldel = "DELETE FROM carretilla WHERE usercod = %d AND codprd = %d;";

            return ejecutarNonQuery(
                sprintf($sqldel, $usuario, $codprod)
            );
        }
    }

    return 0;
}


/**
 * Get Products in Cart for unique user (Anonimo)
 *
 * @param string $uniqueUser Codigo de Sesión anonima
 *
 * @return integer
 */
function getCartProductsData($uniqueUser)
{
    //Cantidad de productos que hay en la carretilla aninoma que no han vencido
    $sqlstr = "SELECT count(*) AS productos FROM `carretillaanon`
               WHERE anoncod = '%s' AND TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d;";

    $data = obtenerUnRegistro(
        sprintf($sqlstr, $uniqueUser, getUnAuthTimeDelta())
    );

    if (count($data) > 0)
    {
        return $data["productos"];
    }

    return 0;
}


/**
 * Get Products in Cart for authenticated user
 *
 * @param integer $usercod Código de usuario Autenticado
 *
 * @return integer
 */
function getCartProducts($usercod)
{
    //Cantidad de productos que hay en la carretilla autenticada que no han vencido
    $sqlstr = "SELECT count(*) AS productos FROM `carretilla`
               WHERE usercod = %d AND TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d;";

    $data = obtenerUnRegistro(
        sprintf($sqlstr, $usercod, getAuthTimeDelta())
    );

    if (count($data) > 0) 
    {
        return $data["productos"];
    }

    return 0;
}


/**
 * Pasa los productos de la carretilla anonima a la carretilla autenticada
 *
 * @param string  $uniqueUser Código de Usuario Anonimo
 * @param integer $user       Código de Usuario Autenticado
 *
 * @return integer  Cantidad de Productos en la Carretilla Autenticada
 */
function passAnonCartToCart($uniqueUser, $user)
{
    // Iniciamos Transacción para realizar varias sentencias (ES COMO UN PROCEDIMIENTO ALMACENADO. //BEGIN)
    // Y confirmar al final del Ciclo si no hay algun error
    iniciarTransaccion();

    $sqlins = "INSERT INTO `carretilla` (`usercod`, `codprd`, `crrctd`, `crrprc`, `crrfching`)
               SELECT %d as `usercodt`, `codprd` as codprdt, `crrctd` as crrctdt, `crrprc` as crrprct, `crrfching` as crrfchingt
               FROM `carretillaanon`
               WHERE `anoncod` = '%s'
               ON DUPLICATE KEY UPDATE `carretilla`.`crrctd` = `carretilla`.crrctd + VALUES(`carretilla`.`crrctd`), crrfching = now();";

    ejecutarNonQuery(
        sprintf($sqlins, $user, $uniqueUser)
    );

    //Se borra la carretill anonima del unique user
    $sqldel = "DELETE FROM `carretillaanon` WHERE anoncod = '%s';";

    ejecutarNonQuery(
        sprintf($sqldel, $uniqueUser)
    );

    terminarTransaccion(); //COMMIT END
    //terminarTransaccion(false); //ROLLBACK END

    //Se retorna cantidad de productos que hay en la carretilla
    return getCartProducts($user);
}



/**
 * Obtiene los Productos de la Carretilla Anónima (DETALLE)
 *
 * @param integer $usuario Código de Usuario Anonimo
 *
 * @return array Registros de Productos en la Carretilla
 */
function getAnonCartDetail($usuario)
{
    $sqlstr = "SELECT a.codprd, b.skuprd, b.dscprd, a.crrctd, a.crrprc
               FROM `carretillaanon` a INNER JOIN `productos` b ON a.codprd = b.codprd
               WHERE a.anoncod = '%s' AND TIME_TO_SEC(TIMEDIFF(now(), a.crrfching)) <= %d;";

    $arrProductos = obtenerRegistros(
        sprintf($sqlstr, $usuario, getUnAuthTimeDelta())
    );

    $arrProductosFinal = array();
    $arrProductosFinal["products"] = array();
    $arrProductosFinal["totctd"] = 0; //Para acumular cantidad de cada producto
    $arrProductosFinal["total"] = 0; //Para acumular el total por producto y mostrar total final
    $counter = 1;

    foreach ($arrProductos as $producto) 
    {
        $producto["line"] = $counter;
        $producto["total"] = number_format($producto["crrctd"] * $producto["crrprc"], 2);
        $arrProductosFinal["totctd"] += $producto["crrctd"];
        $arrProductosFinal["total"] += ($producto["crrctd"] * $producto["crrprc"]);
        $arrProductosFinal["products"][] = $producto; //Todo se guarda aqui
        $counter ++;
    }

    $arrProductosFinal["total"] = number_format($arrProductosFinal["total"], 2);

    return $arrProductosFinal;
}


/**
 * Obtiene los Productos de la Carretilla autenticada (DETALLE)
 *
 * @param integer $usuario Código de Usuario
 *
 * @return array Registros de Productos en la Carretilla
 */
function getAuthCartDetail($usuario)
{
    $sqlstr = "SELECT a.codprd, b.skuprd, b.dscprd, a.crrctd, a.crrprc
               FROM `carretilla` a INNER JOIN `productos` b ON a.codprd = b.codprd
               WHERE a.usercod = '%s' AND TIME_TO_SEC(TIMEDIFF(now(), a.crrfching)) <= %d;";

    $arrProductos = obtenerRegistros(
        sprintf($sqlstr, $usuario, getAuthTimeDelta())
    );

    $arrProductosFinal = array();
    $arrProductosFinal["products"] = array();
    $arrProductosFinal["totctd"] = 0; //Para acumular cantidad de cada producto
    $arrProductosFinal["total"] = 0; //Para acumular el total por producto y mostrar total final
    $counter = 1;

    foreach ($arrProductos as $producto) 
    {
        $producto["line"] = $counter;
        $producto["total"] = number_format($producto["crrctd"] * $producto["crrprc"], 2);
        $arrProductosFinal["totctd"] += $producto["crrctd"];
        $arrProductosFinal["total"] += ($producto["crrctd"] * $producto["crrprc"]);
        $arrProductosFinal["products"][] = $producto; //Todo se guarda aqui
        $counter ++;
    }

    $arrProductosFinal["total"] = number_format($arrProductosFinal["total"], 2);

    return $arrProductosFinal;
}



/**
 * Borra la carretilla completa autenticada
 *
 * @param Integer $usuario Código de Usuario
 *
 * @return integer Registro Afectados
 */

 function deleteCartAuth($usuario)
 {
     $sqlDelete = "DELETE FROM carretilla WHERE usercod = %d;";

     return ejecutarNonQuery(
        sprintf($sqlDelete, $usuario)
     );
 }


 /**
 * Borra la carretilla completa no autenticada
 *
 * @param string $uniqueUser Usuario Anónimo
 *
 * @return integer Registros Afectados
 */

 function deleteCartUnAuth($uniqueUser)
 {
     $sqlDelete = "DELETE FROM carretillaanon WHERE anoncod = %d;";

     return ejecutarNonQuery(
        sprintf($sqlDelete, $uniqueUser)
     );
 }


 /**
 * Elimina los productos reservados fuera de tiempo en ambas carretillas
 * Y se devuelve la cantidad total eliminada
 *
 * @return void
 */
function cleanTimeOutCart()
{
    $contador = 0;

    iniciarTransaccion(); //Como un Procedimiento Almacenado

    //Borrando Carretilla Anonima
    $sqlDel = "DELETE FROM carretillaanon WHERE TIME_TO_SEC(TIMEDIFF(now(), crrfching)) > %d";

    $contador += ejecutarNonQuery(
        sprintf($sqlDel, getUnAuthTimeDelta())
    );
    
    // Borrando Carretilla Autenticada
    $sqlDel = "DELETE FROM carretilla WHERE TIME_TO_SEC(TIMEDIFF(now(), crrfching)) > %d";

    $contador += ejecutarNonQuery(
        sprintf($sqlDel, getAuthTimeDelta())
    );

    terminarTransaccion();

    return $contador;
}

?>