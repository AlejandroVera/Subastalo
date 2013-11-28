<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

//Procesado del formulario
if (isset($_GET['validate'])) {

	if (isset($_POST['palabra_clave'])) {
		$palabraClave = "%";
		$palabraClave .= secure_text_query($_POST['palabra_clave']);
		$palabraClave .= "%";

		$results = busqueda($palabraClave);
		$columns = array("Tipo", "Nombre", "Descripción", "Tiempo Restante", "Fecha de creación");
		$tabla = createTable($columns, $results);

		$smarty -> assign('tabla', $results);
		//$smarty -> display('busqueda.tpl');
		//sendAjaxData(array('msg' => $results));
	}

} else if (isset($_GET['palabra_clave'])) {
	$palabraClave = "%";
	$palabraClave .= secure_text_query($_GET['palabra_clave']);
	$palabraClave .= "%";

	$results = busqueda($palabraClave);
	if (!empty($results)){
		$columns = array("Imagen","Tipo", "Nombre", "Descripción", "Tiempo Restante", "Fecha de creación");
		$tabla = createTable($columns, $results);
	}else{
		$tabla = "Lo sentimos pero no hay resultados para su término de búsqueda.";
	}
			
	$smarty -> assign('tabla', $tabla);
	;
	$smarty -> assign('css', array("busqueda.css"));
	$smarty -> assign('scripts', array("busqueda.js", "jquery.tablesorter.min.js"));
	$smarty -> assign('nivelAcceso', estoy_logeado());	
	$smarty -> assign('nombreUsuario', userName());
	$smarty -> assign('aceptaMsg', aceptaMensajes(userId()));	
	$smarty -> display('busqueda.tpl');
	

} else {//Mostrar el formulario

	//$smarty->assign('name', 'Ned');
	$results = array();
	$smarty -> assign('tabla', $results);
	$smarty -> assign('scripts', array("busqueda.js", "jquery.tablesorter.min.js"));
	$smarty -> assign('css', array("busqueda.css"));
	$smarty -> display('busqueda.tpl');
}

/*
 * TODO: FILTRO
 */
function busqueda($palabraClave) {

	$results = array();

	/*$results[] = "Tipo";
	 $results[] = "Nombre";
	 $results[] = "Descripción";
	 //$results[] = "Imagen"; ?? Esperar a poder subir imagenes
	 $results[] = "Tiempo Restante<br />/Puntos Necesarios";
	 $results[] = "Fecha de creación";*/

	$res = doquery("SELECT * FROM {{table}} WHERE nombre LIKE '$palabraClave'", 'subastas', false);

	while ($resultado = mysqli_fetch_assoc($res)) {
			
		if ($resultado['imagen'] !==""){
			$imagenes = explode("|", $resultado['imagen']);	
			$results[] = "<img src=images/uploaded/".$imagenes[0]. ">"; //Imagen*/
		}else{
			$results[] = "<img src= images/noImage.jpg>";
		}
		$results[] = 'Subasta';
		//TODO: enlace provisional, cambiar en el futuro
		$results[] = "<a href='" . IS2_ROOT_PATH . "visualizarProducto.php?&id=" . $resultado['id'] . "'>" . $resultado['nombre'] . "</a>";
		//Enlace al producto
		$results[] = $resultado['descripcion'];
		
		$tiempoRestante = ($resultado['comienzo'] + $resultado['duracion']) - time();

		if ($tiempoRestante < 0) {
			$results[] = "Finalizada";
		} else {
			$results[] = time_elapsed($tiempoRestante);
		}
		$results[] = date(" H:m:s d/m/Y", $resultado['fechaCreacion']);

	}

	/*$res = doquery("SELECT * FROM {{table}} WHERE nombre LIKE '$palabraClave'", 'ofertas', false);

	 while ($resultado = mysqli_fetch_assoc($res)) {

	 $results[] = 'Oferta';
	 //TODO: enlace provisional, cambiar en el futuro
	 $results[] = "<a href='" . IS2_ROOT_PATH . "/ofertas/" . $resultado['id'] . "'>" . $resultado['nombre'] . "</a>";
	 $results[] = $resultado['descripcion'];
	 /*$results[] = "<img src='"$resultado['imagen'] /img>"; //Imagen
	 $results[] = $resultado['precio'];

	 $results[] = date(" H:m:s d/m/Y", $resultado['fechaCreacion']);

	 }*/
	return $results;
}

function time_elapsed($secs) {
	$bit = array('y' => $secs / 31556926 % 12, 'meses' => $secs / 604800 % 52, 'd' => $secs / 86400 % 7, 'h' => $secs / 3600 % 24, 'min' => $secs / 60 % 60, 's' => $secs % 60);

	$ret = array();
	foreach ($bit as $k => $v)
		if ($v > 0)
			$ret[] = $v . $k;

	return join(' ', $ret);
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
?>