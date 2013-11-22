<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

//Procesado del formulario
if (isset($_GET['validate'])) {

	$id = $_SESSION['USUARIO']['id'];
	
	//query que devuelve Puntos de Subasta asociado a un username
	$res = doquery("SELECT PuntosSubasta FROM {{table}} WHERE id = '{$id}' LIMIT 1", 'usuarios', FALSE);

	//extraemos el registro de este usuario
	$row = mysqli_fetch_assoc($res);

	if ($row) {
		//se obtiene el valor resultante tras recargar los puntos
		$valor = $row['PuntosSubasta']+(int)$_POST['valor'];
		//se actualiza la base de datos con la nueva cantidad de puntos
		$fields = 'PuntosSubasta=' . "'{$valor}'";
		$res = doquery("UPDATE {{table}} SET {$fields} WHERE id='{$id}'", 'usuarios');
	} else {
		//El usuario no existe
		return false;
	}


} else {//Mostrar el formulario
	$smarty -> assign('scripts', array("recargaPuntos.js"));
	$smarty -> assign('IS_CONTENT', false);
	$smarty -> assign('nivelAcceso', estoy_logeado());
	$smarty -> display('recargaPuntos.tpl');
}
?>