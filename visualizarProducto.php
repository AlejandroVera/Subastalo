<?php
define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

$results = array();

if(isset($_GET['tipo'])&&isset($_GET['id']) ){
		
	if($_GET['tipo'] == "subasta"){
		$results=obtenerDatos($_GET['id']);
	}
	else if($_GET['tipo'] == "oferta"){
		//TODO 
	}
	else echo "Tipo incorrecto";
	
		
	$smarty -> assign('IS_CONTENT', false);
	$smarty->assign('res',$results);
	$smarty->assign('scripts', array("visualizarProducto.js","jquery.nivo.slider.pack.js"));
	$smarty->assign('css', array("nivo-slider.css","themes/default/default.css"));
	$smarty -> assign('nombreUsuario', userName());
	$smarty->display('visualizarProducto.tpl');


}
else if(isset($_GET['terminado'])){
	$results=obtenerDatos($_GET['id']);
	$smarty -> assign('IS_CONTENT', false);
	$smarty->assign('res',$results);
	$smarty->assign('scripts', array("jquery.nivo.slider.pack.js"));
	$smarty->assign('css', array("nivo-slider.css","themes/default/default.css"));
	$smarty -> assign('nombreUsuario', userName());
	$smarty->display('visualizarProductoTerminado.tpl');
}
else {
	echo "No se pasa el tipo o id de producto";
}

function obtenerDatos($id){
	$results=array();
	$res = doquery("SELECT * FROM {{table}} WHERE subasta={$id} AND puntos = (SELECT MAX(puntos) FROM {{table}} WHERE subasta={$id})", 'pujas', false);
		
		while ($resultado = mysqli_fetch_assoc($res)) {
		print_r($resultado);	
		$results['usrID'] = $resultado['usuario'];
		$results['puntos'] = $resultado['puntos'];
		$results['ganada'] = $resultado['ganada'];
		$results['subasta'] = $resultado['subasta'];
		}
		
		$DatSub = doquery("SELECT * FROM {{table}} WHERE id = {$results['subasta']}", 'subastas', false);	
		while ($datosProd = mysqli_fetch_assoc($DatSub)){
		$results['nombre'] = $datosProd['nombre'];
		$results['descripcion'] = $datosProd['descripcion'];
		$results['comienzo'] = $datosProd['comienzo'];
		$results['duracion'] = $datosProd['duracion'];
		$results['imagen'] = $datosProd['imagen'];
		}
		$nomUsr = doquery("SELECT username FROM {{table}} WHERE id = {$results['usrID']}", 'usuarios', false);	
		$nameUsr=mysqli_fetch_assoc($nomUsr);
		$results['usuario'] = $nameUsr['username'];
		
		//Calculo de la finalizacion de producto
		$fin = $results['comienzo']+$results['duracion'];
		$results['hoy'] = $fin - time();
		//Obtencion de los nombres de las imagenes
		$imagenes=explode("|",$results['imagen']);
		$results['imagenes']=$imagenes;
		$results['idProducto']=$_GET['id'];
		
		return $results;
}

?>
	