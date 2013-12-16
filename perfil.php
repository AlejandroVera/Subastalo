<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

//Cargamos las función de validaciones
require (IS2_ROOT_PATH . "includes/validate.php");

$datos = array();
$lista = array();
$id = userId();
//id usuario logueado
$id_perfil = (double)$_GET['id_perfil'];
$datos = obtenerDatos($id_perfil);
$dat = doquery("SELECT count(*) as total FROM {{table}} WHERE idTo='{$id}' AND leido=0", 'mensajes', true);
$numMsg = $dat['total'];
$lista = obtenerLista($id_perfil);

$smarty -> assign('scripts', array("perfil.js"));
$smarty -> assign('IS_CONTENT', false);
$smarty -> assign('lista', $lista);
$smarty -> assign('res', $datos);
$smarty -> assign('idPerfil', $id_perfil);
if ($id != null)
	$smarty -> assign('usuarioLogueado', $id);
$smarty -> assign('nivelAcceso', estoy_logeado());
$smarty -> assign('nombreUsuario', userName());
$smarty -> assign('aceptaMsg', aceptaMensajes(userId()));
$smarty -> assign('numMensajes', $numMsg);
$smarty -> display('perfil.tpl');

function obtenerLista($id_perfil) {
	$lista = array();
	$resList = doquery("SELECT * FROM {{table}} WHERE idUsuario = '{$id_perfil}' LIMIT 1", 'listaIntereses', false);
	while ($listares = mysqli_fetch_assoc($resList)) {
		$lista['Joyeria y Belleza'] = $listares['Joyeria y Belleza'];
		$lista['Electronica'] = $listares['Electronica'];
		$lista['Hogar y Decoracion'] = $listares['Hogar y Decoracion'];
		$lista['Entretenimiento'] = $listares['Entretenimiento'];
		$lista['Deportes y Tiempo Libre'] = $listares['Deportes y Tiempo Libre'];
		$lista['Coleccionismo y Arte'] = $listares['Coleccionismo y Arte'];
		$lista['Motor'] = $listares['Motor'];
	}
	return $lista;

}
?>
