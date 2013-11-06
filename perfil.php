<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

//Cargamos las función de validaciones
require (IS2_ROOT_PATH . "includes/validate.php");

if(!isset($_GET['id_perfil'])){
	$smarty -> assign('muestraBotonMsg', 0);
	$id_perfil = userId();
	$smarty -> assign('scripts', array("perfil.js"));
}else{
	$id_perfil = (double) $_GET['id_perfil'];
		$res = doquery("SELECT aceptaMensajes FROM {{table}} WHERE id = '{$id_perfil}' LIMIT 1", 'usuarios', true);
	$smarty -> assign('muestraBotonMsg', $res['aceptaMensajes']);
	$smarty -> assign('scripts', array("mensajePrivado.js", "perfil.js"));
}
$smarty -> assign('idPerfil', $id_perfil);
$smarty -> assign('usuarioLogueado', userId()); 
$smarty -> display('perfil.tpl');
?>
