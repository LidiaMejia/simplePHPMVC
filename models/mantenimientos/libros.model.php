<?php

/**
 * Modelo de la Tabla libros
 * 
 * @return array
 */

 require_once "libs/dao.php";

 //Traer los datos de todos los libros
 function todosLibros()
 {
    $arrayLibros = array();
    $sqlSelect = "SELECT * FROM libros;"; 

    $arrayLibros = obtenerRegistros($sqlSelect);

    return $arrayLibros;
 }

 //Datos de un libro
 function datosUnLibro($librocod)
 {
     $sqlSelect = "SELECT * FROM libros WHERE librocod = %d;";

     return obtenerUnRegistro(
        sprintf($sqlSelect, $librocod)
     );
 }

 function insertarLibro($libronom, $libroautor, $libroest)
 {
     $sqlInsert = "INSERT INTO libros (libronom, libroautor, libroest) VALUES ('%s', '%s', '%s');";

     $isOK = ejecutarNonQuery(
        sprintf($sqlInsert, $libronom, $libroautor, $libroest)
     );

     return getLastInserId();
 }

 function updateLibro($librocod, $libronom, $libroautor, $libroest)
 {
     $sqlUpdate = "UPDATE libros SET libronom = '%s', libroautor = '%s', libroest = '%s' WHERE librocod = %d;";

     return ejecutarNonQuery(
        sprintf($sqlUpdate, $libronom, $libroautor, $libroest, $librocod)
     );
 }

 function eliminarLibro($librocod)
 {
     $sqlDelete = "DELETE FROM libros WHERE librocod = %d;";

     return ejecutarNonQuery(
        sprintf($sqlDelete, $librocod)
     );
 }

?>