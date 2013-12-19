<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

//Cargamos las función de validaciones
require (IS2_ROOT_PATH . "includes/validate.php");

$datos = array();
$lista = array();
$id = userId();//id usuario logueado
$id_perfil = (double)$_GET['id_perfil'];
$datos = obtenerDatos($id_perfil);
$dat = doquery("SELECT count(*) as total FROM {{table}} WHERE idTo='{$id}' AND leido=0", 'mensajes', true);
$numMsg = $dat['total'];
$lista = obtenerLista($id_perfil);
$data = obtenerHistorial($id_perfil);
$columns = array("Nombre", "Puntos", "Fecha");
$historial = createTable($columns, $data);

$smarty -> assign('scripts', array("perfil.js", "jquery.tablesorter.min.js"));
$smarty -> assign('IS_CONTENT', false);
$smarty -> assign('lista', $lista);
$smarty -> assign('res', $datos);
$smarty -> assign('idPerfil', $id_perfil);
$smarty -> assign('historial', $historial);

if ($id != null)
	$smarty -> assign('usuarioLogueado', $id);

$smarty -> assign('nivelAcceso', estoy_logeado());
$smarty -> assign('nombreUsuario', userName());
$smarty -> assign('aceptaMsg', aceptaMensajes($id_perfil));
$smarty -> assign('numMensajes', $numMsg);
$smarty -> assign('css', array("perfil.css"));

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

function createTable($columns, $data) {

	$nColumns = count($columns);
	$content = "<thead>";
	$content .= "<tr>";

	foreach ($columns as $i => $value) {
		$content .= "<th>" . $value . "</th>";
	}
	$content .= '</tr></thead>';
	$content .= "<tbody><tr>";

	foreach ($data as $i => $value) {
		if ($i % $nColumns == 0 && $i !== 0) {
			$content .= '</tr><tr>';
		}
		$content .= '<td>' . $value . '</td>';
	}
	$content .= '</tr></tbody>';
	return $content;
}

function obtenerHistorial($userId) {

	$results = array();

	$res = doquery("SELECT * FROM {{table}} WHERE usuario = $userId", 'pujas', false);

	while ($resultado = mysqli_fetch_assoc($res)) {
		//TODO: Enlace temporal

		$name = doquery("SELECT nombre FROM {{table}} WHERE id = $resultado[subasta]", 'subastas', true);
		$results[$resultado['fecha']]['nombre'] = "<a href='" . IS2_ROOT_PATH . "visualizarProducto.php?tipo=subasta&id=" . $resultado['subasta'] . "'>" . $name['nombre'] . "</a>";
		$results[$resultado['fecha']]['fecha'] = date(" H:m:s d/m/Y", $resultado['fecha']);
		$results[$resultado['fecha']]['puntos'] = $resultado['puntos'];
		/*
		if ($resultado['ganada'] == 1) {
			$results[$resultado['fecha']]['tipo'] = "Puja ganada";
		} else {
			$results[$resultado['fecha']]['tipo'] = "Puja";
		}*/
	}

	krsort($results);
	//Ordenamos por fecha de forma descendente => más nuevo a más viejo
	$resultados = array();
	foreach ($results as $i => $value) {//Lo pasamos a un array de dimension uno para la funcion de la tabla
		$resultados[] = $value['nombre'];
		$resultados[] = $value['puntos'];
		$resultados[] = $value['fecha'];
	}
	return $resultados;

}
?>
