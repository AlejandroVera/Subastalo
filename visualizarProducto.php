<?php
define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

$results = array();

if (isset($_GET['tipo']) && isset($_GET['id'])) {

	if ($_GET['tipo'] == "subasta") {
		$results = obtenerDatosSubastas($_GET['id']);
	} else if ($_GET['tipo'] == "oferta") {
		//TODO
	} else
		echo "Tipo incorrecto";

	$smarty -> assign('IS_CONTENT', false);
	$smarty -> assign('res', $results);
	$smarty -> assign('scripts', array("visualizarProducto.js", "jquery.nivo.slider.pack.js"));
	$smarty -> assign('css', array("nivo-slider.css", "themes/default/default.css", "subasta.css"));
	$smarty -> assign('nombreUsuario', userName());
	$smarty -> display('visualizarProducto.tpl');

} else if (isset($_GET['terminado'])) {
	$results = obtenerDatosSubastas($_GET['id']);
	$smarty -> assign('IS_CONTENT', false);
	$smarty -> assign('res', $results);
	$smarty -> assign('scripts', array("jquery.nivo.slider.pack.js"));
	$smarty -> assign('css', array("nivo-slider.css", "themes/default/default.css", "subasta.css"));
	$smarty -> assign('nombreUsuario', userName());
	$smarty -> display('visualizarProductoTerminado.tpl');
} else if (isset($_POST['idProducto']) && isset($_POST['puja'])) {
	if (isset($_SESSION['USUARIO'])) {
		$userID = userId();
		$idProducto = $_POST['idProducto'];
		$puja = $_POST['puja'];
		$fields = '`id`, `subasta`, `puntos`, `usuario`, `fecha`, `ganada`';
		$hoy = time();
		$values = "NULL, " . $idProducto . ", " . $puja . "," . $userID . "," . $hoy . ", '0'";
		$UsrP = doquery("SELECT PuntosSubasta FROM {{table}} WHERE id = {$userID}", 'usuarios', false);
		$UsrPoints = mysqli_fetch_assoc($UsrP);
		$PuntoSubasta = (double)$UsrPoints['PuntosSubasta'];
		if ($puja > $PuntoSubasta) {
			sendAjaxData(array('msg' => "No tiene puntos suficientes, por favor recargue más puntos.", 'url' => "RecargaPuntos.php"));
		} else {
			//$mPuja = doquery("SELECT max(`puntos`) FROM {{table}} WHERE `subasta` = '{$idProducto}'", 'pujas', false);
			$mPuja = doquery("SELECT puntos FROM {{table}} WHERE subasta={$idProducto} AND puntos = (SELECT MAX(puntos) FROM {{table}} WHERE subasta={$idProducto})", 'pujas', false);
			$mayorPuja = mysqli_fetch_assoc($mPuja);
			//$mayorPuj=$mayorPuja['max(`puntos`)'];
			$mayorPuj = $mayorPuja['puntos'];
			if ($puja <= $mayorPuj) {
				sendAjaxData(array('msg' => "Debe pujar más puntos que la mayor puja: {$mayorPuj}.", 'url' => "visualizarProducto.php?tipo=subasta&id={$idProducto}"));
			} else {
				$res = doquery("INSERT INTO {{table}} ({$fields}) VALUES ({$values})", 'pujas');
				if ($res) {//Registro correcto
					$PuntoSubasta = $PuntoSubasta - $puja;
					$puntos = doquery("UPDATE {{table}} SET `PuntosSubasta`='{$PuntoSubasta}' WHERE id={$userID}", 'usuarios');
					if ($puntos) {
						$durac = doquery("SELECT duracion FROM {{table}} WHERE id = {$idProducto}", 'subastas', false);
						$duracion = mysqli_fetch_assoc($durac);

						$newDurac = $duracion['duracion'] + 60;
						$upDurac = doquery("UPDATE {{table}} SET `duracion`='{$newDurac}' WHERE id={$idProducto}", 'subastas');
						if ($upDurac) {
							sendAjaxData(array('msg' => "Puja realizado correctamente.", 'url' => "visualizarProducto.php?tipo=subasta&id={$idProducto}"));
						}
					}
				}
			}
		}
	} else {
		sendAjaxData(array('msg' => "Inicie sesión para poder pujar.", 'url' => "index.php"));
	}
} else {
	echo "Los parámetros son incorrectos.";
}

function obtenerDatosSubastas($id) {
	$results = array();
	$DatSub = doquery("SELECT * FROM {{table}} WHERE id = {$id}", 'subastas', false);
	while ($datosProd = mysqli_fetch_assoc($DatSub)) {
		$results['nombre'] = $datosProd['nombre'];
		$results['descripcion'] = $datosProd['descripcion'];
		$results['comienzo'] = $datosProd['comienzo'];
		$results['duracion'] = $datosProd['duracion'];
		$results['imagen'] = $datosProd['imagen'];
		$results['pujado'] = $datosProd['pujado'];
	}
	if ($results['pujado'] == 1) {
		//$res = doquery("SELECT max(puntos) FROM {{table}} WHERE 'subasta' = {$id}", 'pujas', false);
		$res = doquery("SELECT * FROM {{table}} WHERE subasta={$id} AND puntos = (SELECT MAX(puntos) FROM {{table}} WHERE subasta={$id})", 'pujas', false);
		while ($resultado = mysqli_fetch_assoc($res)) {

			$results['usrID'] = $resultado['usuario'];
			$results['puntos'] = $resultado['puntos'];
			$results['ganada'] = $resultado['ganada'];
			$results['subasta'] = $resultado['subasta'];
		}

		$nomUsr = doquery("SELECT username FROM {{table}} WHERE id = {$results['usrID']}", 'usuarios', false);
		$nameUsr = mysqli_fetch_assoc($nomUsr);
		$results['usuario'] = $nameUsr['username'];

	}
	//Calculo de la finalizacion de producto
	$fin = $results['comienzo'] + $results['duracion'];
	$results['hoy'] = $fin;

	//Obtencion de los nombres de las imagenes
	$imagenes = array();
	
	if ($results['imagen'] != "") {
		$imagenes = explode("|", $results['imagen']);
	}
	
	$results['imagenes'] = $imagenes;
	$results['idProducto'] = $id;

	return $results;
}
?>
