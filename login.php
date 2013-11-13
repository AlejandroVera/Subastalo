<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

if (estoy_logeado()) {// si estoy logeado
	header('Location: perfil.php');
	//saltamos a la página de login
	die('Acceso no autorizado');
	// por si falla el header (solo se pueden mandar las cabeceras si no se ha impreso nada)
}
//Procesado del formulario
if (isset($_GET['validate'])) {

	$email = secure_text_query($_POST['email']);
	$password = $_POST['password'];

	if (login($email, $password)) {
		header("Location: inicio.php");
	}

} else {//Mostrar el formulario

	$smarty -> assign('scripts', array("login.js"));
	$smarty -> assign('IS_CONTENT', false);
	$smarty -> assign('nivelAcceso', estoy_logeado());
	$smarty -> display('login.tpl');
}

/**
 * valida un usuario y contraseña
 * @param string $usuario
 * @param string $password
 * @return bool
 */
function login($email, $password) {

	//usuario y password tienen datos?
	if (empty($email))
		return false;
	if (empty($password))
		return false;

	//query que devuelve password e id asociados a un username
	$res = doquery("SELECT email, username, password, id, nivel_acceso FROM {{table}} WHERE email = '{$email}' LIMIT 1", 'usuarios', FALSE);

	//extraemos el registro de este usuario
	$row = mysqli_fetch_assoc($res);

	if ($row) {
		//Generamos el hash de la contraseña encriptada para comparar o lo dejamos como texto plano
		$hash = sha1($password);
		//comprobamos la contraseña
		if ($email == $row['email'] and $hash == $row['password']) {
			$_SESSION['USUARIO'] = array('username' => $row['username'], 'id' => $row['id'], 'nivel_acceso' => $row['nivel_acceso']);
			//almacenamos en memoria el usuario
			// en este punto puede ser interesante guardar más datos en memoria para su posterior uso, como por ejemplo un array asociativo con el id, nombre, email, preferencias, ....
			return true;
			//usuario y contraseña validadas
		} else {

			unset($_SESSION['USUARIO']);
			//destruimos la session activa al fallar el login por si existia
			return false;
			//no coincide la contraseña
		}
	} else {
		//El usuario no existe
		return false;
	}
}

/*if (!estoy_logeado()) { // si no estoy logeado
 header('Location: login.php'); //saltamos a la página de login
 die('Acceso no autorizado'); // por si falla el header (solo se pueden mandar las cabeceras si no se ha impreso nada)
 }*/
?>