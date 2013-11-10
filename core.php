<?php

//Evitamos que nos pillen la cookie por XSS
ini_set('session.cookie_httponly', true); 

define('INSIDE', true);

//Cargamos la configuración
require(IS2_ROOT_PATH . 'config.php');

//Cargamos e inicializamos la clase de debug
require(IS2_ROOT_PATH . 'includes/debug.php');
$debug = new debug();

//Cargamos la conexión a la BD
require(IS2_ROOT_PATH . 'db/mysql.php');

//Cargamos las funciones de log e iniciamos session
require(IS2_ROOT_PATH . 'login_lib.php');

//Cargamos la sesión
@session_start();

//Cargamos Smarty
require(IS2_ROOT_PATH . 'includes/config/loadSmarty.php');

//Comprobación del nivel de acceso
if (estoy_logeado() < NEEDED_ACCESS_LEVEL){
	header('Location: '.IS2_ROOT_PATH.'index.php'); 
}
?>
