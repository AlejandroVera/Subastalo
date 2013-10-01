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

//Cargamos Smarty
require(IS2_ROOT_PATH . 'includes/config/loadSmarty.php');

//ToDo: load user

//ToDo: check access level

?>
