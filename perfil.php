<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

//Cargamos las función de validaciones
require (IS2_ROOT_PATH . "includes/validate.php");

$datos=array();
$lista=array();
if(!isset($_GET['id_perfil'])){
	
	$id_perfil = userId();
	$datos = obtenerDatos($id_perfil);
	$smarty -> assign('muestraBotonMsg', 0);
	$smarty -> assign('scripts', array("perfil.js"));
	
}else{
	$id_perfil = (double) $_GET['id_perfil'];
	$datos = obtenerDatos($id_perfil);
	$smarty -> assign('muestraBotonMsg', $datos['aceptaMensajes']);	
	$smarty -> assign('scripts', array("mensajePrivado.js", "perfil.js"));
	
}
$lista = obtenerLista($id_perfil);
$smarty -> assign('IS_CONTENT', false);
$smarty -> assign('lista',$lista);
$smarty -> assign('res',$datos);
$smarty -> assign('idPerfil', $id_perfil);
$smarty -> assign('usuarioLogueado', userId()); 
$smarty -> display('perfil.tpl');


function obtenerDatos($id_perfil){
	$results=array();
	$res = doquery("SELECT * FROM {{table}} WHERE id = '{$id_perfil}' LIMIT 1", 'usuarios', false);
	while ($resultado = mysqli_fetch_assoc($res)) {
		$results['username'] = $resultado['username'];
		$results['telefono'] = $resultado['telefono'];
		$results['email'] = $resultado['email'];
		$results['productosInteresados']=$resultado['productosInteresados'];
		$results['aceptaMensajes']=$resultado['aceptaMensajes'];
	}
	return $results;
}


function obtenerLista($id_perfil){
	$lista=array();
	$resList = doquery("SELECT * FROM {{table}} WHERE idUsuario = '{$id_perfil}' LIMIT 1", 'listaIntereses', false);
	while ($listares= mysqli_fetch_assoc($resList)) {
		$lista['Joyeria y Belleza']=$listares['Joyeria y Belleza'];
		$lista['Electronica']=$listares['Electronica'];
		$lista['Hogar y Decoracion']=$listares['Hogar y Decoracion'];
		$lista['Entretenimiento']=$listares['Entretenimiento'];
		$lista['Deportes y Tiempo Libre']=$listares['Deportes y Tiempo Libre'];
		$lista['Coleccionismo y Arte']=$listares['Coleccionismo y Arte'];
		$lista['Motor']=$listares['Motor'];
	}
	return $lista;	
	
}
?>
