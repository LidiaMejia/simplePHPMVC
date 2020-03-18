<?php
/**
 * PHP Version 5
 * Application Router
 *
 * @category Router
 * @package  Router
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @author   Luis Fernando Gomez Figueroa <lgomezf16@gmail.com>
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */
session_start();

require_once "libs/utilities.php";

$pageRequest = "home";

if (isset($_GET["page"])) {
    $pageRequest = $_GET["page"];
}

//Incorporando los midlewares son codigos que se deben ejecutar
//Siempre
require_once "controllers/mw/verificar.mw.php";
require_once "controllers/mw/site.mw.php";

// aqui no se toca jajaja la funcion de este index es
// llamar al controlador adecuado para manejar el
// index.php?page=modulo

    //Este switch se encarga de todo el enrutamiento público
switch ($pageRequest) {
    //Accesos Publicos
case "home":
    //llamar al controlador
    include_once "controllers/home.control.php";
    die();
case "login":
    include_once "controllers/security/login.control.php";
    die();
case "logout":
    include_once "controllers/security/logout.control.php";
    die();

//*NUEVA URL  
case "ficha": //*Nombre de la URL en minuscula, sin espacios ni caracteres especiales
    include_once "controllers/ficha.control.php"; //*Con .control se sabe que se esta trabajando en el control de la ficha. NOMENCLATURA
    die(); //*Muere el proceso. Evita que llegue al ultimo punto de ERROR "La pagina no esta disponible"

case "colores":
    include_once "controllers/mantenimientos/colores.control.php";
    die();

case "color":
    include_once "controllers/mantenimientos/color.control.php";
    die(); 
    
 case "libros":
    include_once "controllers/mantenimientos/libros.control.php";
    die();

 case "libro":
    include_once "controllers/mantenimientos/libro.control.php";
    die();

 case "parqueos":
    include_once "controllers/mantenimientos/parqueos.control.php";
    die();
    
 case "parqueo":
    include_once "controllers/mantenimientos/parqueo.control.php";
    die();

 case "centroscostos":
    include_once "controllers/mantenimientos/centroscostos.control.php";
    die();

 case "centrocostos":
    include_once "controllers/mantenimientos/centrocostos.control.php";
    die();

 //En la carpeta security para el registro de usuarios
 case "register":
    include_once "controllers/security/register.control.php";
    die();
}

//Este switch se encarga de todo el enrutamiento que ocupa login
$logged = mw_estaLogueado();
if ($logged) {
    addToContext("layoutFile", "verified_layout");
    include_once 'controllers/mw/autorizar.mw.php';
    if (!isAuthorized($pageRequest, $_SESSION["userCode"])) {
        include_once"controllers/notauth.control.php";
        die();
    }
    generarMenu($_SESSION["userCode"]);
}

require_once "controllers/mw/support.mw.php";
switch ($pageRequest) {
case "dashboard":
    ($logged)?
      include_once "controllers/dashboard.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "users":
    ($logged)?
      include_once "controllers/security/users.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "user":
    ($logged)?
      include_once "controllers/security/user.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "roles":
    ($logged)?
      include_once "controllers/security/roles.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "rol":
    ($logged)?
      include_once "controllers/security/rol.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "programas":
    ($logged)?
      include_once "controllers/security/programas.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "programa":
    ($logged)?
      include_once "controllers/security/programa.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();

case "categorias":
    ($logged)?
      include_once "controllers/mantenimientos/categorias.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();

//*Para agregar una nueva categoria
case "categoria":
    ($logged)?
        include_once "controllers/mantenimientos/categoria.control.php":
        mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();

 //*Seguridad
 case "security":
    ($logged)?
      include_once "controllers/security/security.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
 die();

 //*Mantenimientos
 case "parametros":
    ($logged)?
      include_once "controllers/mantenimientos/mantenimientos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
 die();

}

addToContext("pageRequest", $pageRequest);
require_once "controllers/error.control.php";
