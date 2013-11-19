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

//Cargamos la sesión
@session_start();

//Cargamos Smarty
require(IS2_ROOT_PATH . 'includes/config/loadSmarty.php');

//Comprobación del nivel de acceso
if (estoy_logeado() < NEEDED_ACCESS_LEVEL){
	header('Location: '.IS2_ROOT_PATH.'index.php'); 
}

/**
 * Verifica si el usuario está logeado
 * @return bool
 */
function estoy_logeado() {
     
    if (!isset($_SESSION['USUARIO'])) return 0; //no existe la variable $_SESSION['USUARIO']. No logeado.
    if (!is_array($_SESSION['USUARIO'])) return 0; //la variable no es un array $_SESSION['USUARIO']. No logeado.
    if (empty($_SESSION['USUARIO']['id'])) return 0; //no tiene almacenado el usuario en $_SESSION['USUARIO']. No logeado.
 
    //cumple las condiciones anteriores, entonces es un usuario validado
    return $_SESSION['USUARIO']['nivel_acceso'];
 
}

/**
 * Devuelve el ID del usuario
 * @return int Id del usuario. Null en caso de error
 */
function userId(){
	if(!isset($_SESSION['USUARIO']) || !isset($_SESSION['USUARIO']['id']))
		return null;
	return $_SESSION['USUARIO']['id'];
}


function userName(){
	if(!isset($_SESSION['USUARIO']) || !isset($_SESSION['USUARIO']['id']))
		return null;
	return $_SESSION['USUARIO']['username'];
}

function sendAjaxData($data, $statusCode = 200){
    $data['status'] = $statusCode;
    echo json_encode($data);
}

?>
