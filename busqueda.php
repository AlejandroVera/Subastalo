<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

//Procesado del formulario
if (isset($_GET['validate'])) {
	
	$palabraClave = "%";
	$palabraClave .= secure_text_query($_POST['palabra_clave']);
	$palabraClave .="%";
	
	$results = array();
	
	/*$results[0] = "Nombre";
	$results[1] = "Descripción";
	$results[] = "Imagen"; ?? Esperar a poder subir imagenes
	$results[2] = "Tiempo Restante/Puntos Necesarios";
	$results[3] = "Fecha de creación";*/
	
	$res = doquery("SELECT * FROM {{table}} WHERE nombre LIKE '$palabraClave'", 'productos', false);
	
	while ($resultado = mysqli_fetch_assoc($res)) {
		$tmp = array();
		$results[] = $resultado['nombre'];		
		//TODO: Meter todos los campos dependientes de DB
		//Como estructurar si es tiempor restante/ puntos necesarios
					
		//De esta forma results quedará preparado para usar la funcion html_table de smarty
	}
	
	$smarty->assign('tabla', $results);
	$smarty -> display('busqueda.tpl');	

} else {//Mostrar el formulario

	//$smarty->assign('name', 'Ned');
	$results = array();
	$smarty->assign('tabla', $results);
	$smarty -> display('busqueda.tpl');
}



?>