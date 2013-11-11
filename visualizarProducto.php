<?php
define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

$results = array();

if(isset($_GET['tipo'])&&isset($_GET['id']) ){
		
	if($_GET['tipo'] == "subasta"){
		$res = doquery("SELECT * FROM {{table}} WHERE subasta IN (SELECT MAX({$_GET['id']}) FROM {{table}})", 'pujas', false);
		while ($resultado = mysqli_fetch_assoc($res)) {	
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
		
		
	}
	else if($_GET['tipo'] == "oferta"){
		//TODO 
	}
	else echo "Tipo incorrecto";
$smarty->assign('res',$results);
$smarty->assign('scripts', array("visualizarProducto.js"));
$smarty->display('visualizarProducto.tpl');

}
else if(isset($_GET['terminado'])){
	
	echo "puja terminada!!!!";
}
else {
	echo "Error en el paso de parámetro.";
}

?>
	