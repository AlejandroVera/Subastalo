<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

if (estoy_logeado()) { // si estoy logeado
    header('Location: index.php'); //saltamos a la página de login
    die('Acceso no autorizado'); // por si falla el header (solo se pueden mandar las cabeceras si no se ha impreso nada)
}
//Procesado del formulario
if (isset($_GET['validate'])) {
	
	$email=secure_text_query($_POST['email']);
	$password=$_POST['password'];
		
	if (login($email,$password)){
		header('Location: index.php'); 
	}
		header('Location: login.php'); 
		
} else {//Mostrar el formulario

//TODO:
//$usuarioLogueado=$_SESSION['USUARIO']['id'];
$usuarioLogueado=2;

	$smarty -> assign('scripts', array("escuchaMensajes.js"));
	$smarty -> assign('usuarioLogueado', $usuarioLogueado);
	$smarty -> display('login.tpl');
}


/*if (!estoy_logeado()) { // si no estoy logeado
    header('Location: login.php'); //saltamos a la página de login
    die('Acceso no autorizado'); // por si falla el header (solo se pueden mandar las cabeceras si no se ha impreso nada)
}*/

?>