<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");


$userId = 26; //TODO: Obtener id de usuario?????Como diferenciar de mi historial a otro???
$results = obtenerHistorial($userId);
$smarty -> assign('historial', $results);
$smarty -> display('historial.tpl');
	


function obtenerHistorial($userId){	
	
	$results = array();	
	
	$res = doquery("SELECT * FROM {{table}} WHERE usuarioComprador = $userId", 'ofertas', false);
	
	while ($resultado = mysqli_fetch_assoc($res)) {		
		//TODO: Enlace temporal
		$results[$resultado['fechaCompra']]['nombre'] = "<a href='".IS2_ROOT_PATH."visualizarProducto.php?tipo=oferta&id=".$resultado['id']."'>".$resultado['nombre']."</a>";
		$results[$resultado['fechaCompra']]['fecha'] = date(" H:m:s d/m/Y", $resultado['fechaCompra']);
		$results[$resultado['fechaCompra']]['puntos'] = $resultado['precio'];
		$results[$resultado['fechaCompra']]['tipo'] = "Oferta";
		//$results[$resultado['fechaCompra']]['ganada'] = 1;						
	}
	
	$res = doquery("SELECT * FROM {{table}} WHERE usuario = $userId", 'pujas', false);
	
	while ($resultado = mysqli_fetch_assoc($res)) {		
		//TODO: Enlace temporal
		
		$name = doquery("SELECT nombre FROM {{table}} WHERE id = $resultado[subasta]", 'subastas', true);	
		$results[$resultado['fecha']]['nombre'] = "<a href='".IS2_ROOT_PATH."visualizarProducto.php?tipo=subasta&id=".$resultado['id']."'>".$name['nombre']."</a>";
		$results[$resultado['fecha']]['fecha'] = date(" H:m:s d/m/Y", $resultado['fecha']);
		$results[$resultado['fecha']]['puntos'] = $resultado['puntos'];
		$results[$resultado['fecha']]['tipo'] = "Subasta";
		if ($resultado['ganada']==1){
			$results[$resultado['fecha']]['tipo'] = "Puja ganada";
		}
		else{
			$results[$resultado['fecha']]['tipo'] = "Puja";
		}						
	}
	
	krsort($results); //Ordenamos por fecha de forma descendente => más nuevo a más viejo
	return $results;

} 

function sendAjaxData($data, $statusCode = 200) {
	$data['status'] = $statusCode;
	echo json_encode($data);
}
?>