<?php
#Descomentar estas lineas solo si el servidor en el que se utilizará el framework lo soporta
//
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);

// inicio de la sesion
session_start();

//Información para la conexion a la base de datos
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '1c92201';
$dbName = 'tracking';

// Configurando automaticamente el directorio raíz en la web y en el servidor
$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];

$webRoot  = str_replace(array($docRoot, 'system/config.php'), '', $thisFile);
$srvRoot  = str_replace('system/config.php', '', $thisFile);

//nombre del directorio en el que se encuentra la aplicacion
$directorio = $webRoot;
//comprobamos si esta en localhost o en un servidor real
if(isset($_SERVER['HTTP_HOST'])){
	if ($_SERVER['HTTP_HOST']=='localhost'){
	    $ruta = 'http://'.$_SERVER['HTTP_HOST'].$directorio;
	}else if($directorio!=""){
	    $ruta = 'http://'.$_SERVER['HTTP_HOST'].$directorio;
	}else{
	    $ruta = 'http://'.$_SERVER['HTTP_HOST'].'/';
	}
}else{
$ruta = $srvRoot;
}

#Definiendo las constantes...
#-> WEB_ROOT almacena la ruta http raiz
define('WEB_ROOT', $ruta);

#-> SRV_ROOT almacena la ruta raiz en el servidor
define('SRV_ROOT', $srvRoot);

#-> define el directorio del tema a utilizar para la capa "Vista"
define('_THEME_DIRNAME_', 'theme/planetaenjoy/');

//defino el directorio de imagenes del sistema y no del tema
define('IMAGE_DIR', SRV_ROOT . 'images/');

//defino el directorio para las clases y aplicaciones de terceros
define('TPAPP', SRV_ROOT. 'tpapp');

//defino las imagenes a utilizar por el sistema y por el navegador WEB
define('UPLOADED_FOLDER', WEB_ROOT. 'uploaded-folder/');
// algunas limitaciones para las imagenes
// activa y desactiva el ancho maximo permitido para las imagenes
define('LIMIT_IMG_WIDTH',     true);

// ancho maximo para todas las imagenes
define('MAX_IMAGE_WIDTH', 700);

// el ancho del tumbnail o imagen pequeña
define('THUMBNAIL_WIDTH', 100);

// defino si es necesario utilizar login
define('USE_LOGIN', true);

// ya que la mayoria de las paginas requieren del acceso a la base de datos
// y las librerias en comun tambien
// es logico incluir esta libreria aquí
require_once 'database.php';

?>
