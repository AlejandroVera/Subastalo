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
	
	$results = busqueda($palabraClave);
	
	$smarty->assign('tabla', $results);
	$smarty -> display('busqueda.tpl');	

} else {//Mostrar el formulario

	//$smarty->assign('name', 'Ned');
	$results = array();
	$smarty->assign('tabla', $results);
	$smarty -> display('busqueda.tpl');
}

/*
 * TODO: FILTRO
 */
function busqueda ($palabraClave){
	
	$results = array();
	
	$results[] = "Tipo";
	$results[] = "Nombre";
	$results[] = "Descripción";
	//$results[] = "Imagen"; ?? Esperar a poder subir imagenes
	$results[] = "Tiempo Restante<br />/Puntos Necesarios";
	$results[] = "Fecha de creación";
	
	$res = doquery("SELECT * FROM {{table}} WHERE nombre LIKE '$palabraClave'", 'subastas', false);
	
	while ($resultado = mysqli_fetch_assoc($res)) {
			
		$results[]='Subasta';		
		//TODO: enlace provisional, cambiar en el futuro	
		$results[] = "<a href='".IS2_ROOT_PATH."/subastas/".$resultado['id']."'>".$resultado['nombre']."</a>"; //Enlace al producto
		$results[] = $resultado['descripcion'];
		/*$results[] = "<img src='"$resultado['imagen'] /img>"; //Imagen*/
		$tiempoRestante = time_elapsed(($resultado['comienzo'] + $resultado['duracion']) - time());
		if ($tiempoRestante < 0){
			$results[] = "Finalizada";
		}else{
			$results[] = $tiempoRestante;
		}
		$results[] = date(" H:m:s d/m/Y", $resultado['fechaCreacion']);								
				
	}
	
	$res = doquery("SELECT * FROM {{table}} WHERE nombre LIKE '$palabraClave'", 'ofertas', false);
	
	while ($resultado = mysqli_fetch_assoc($res)) {
			
		$results[]='Oferta';
		//TODO: enlace provisional, cambiar en el futuro		
		$results[] = "<a href='".IS2_ROOT_PATH."/ofertas/".$resultado['id']."'>".$resultado['nombre']."</a>"; 
		$results[] = $resultado['descripcion'];
		/*$results[] = "<img src='"$resultado['imagen'] /img>"; //Imagen*/
		$results[] = $resultado['precio'];
		
		$results[] = date(" H:m:s d/m/Y", $resultado['fechaCreacion']);								
				
	}
	
	return $results;
}

function time_elapsed($secs){
    $bit = array(
        'y' => $secs / 31556926 % 12,
        'meses' => $secs / 604800 % 52,
        'd' => $secs / 86400 % 7,
        'h' => $secs / 3600 % 24,
        'min' => $secs / 60 % 60,
        's' => $secs % 60
        );
        
    foreach($bit as $k => $v)
        if($v > 0)$ret[] = $v . $k;
        
    return join(' ', $ret);
}
?>