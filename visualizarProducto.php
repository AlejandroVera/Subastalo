<?php
define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

$results = array();

/*Caso en que se quiere visualizar un producto.
 * Parametros:
 * id=id del producto
 */
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$results = obtenerDatosSubastas($id);
	$resp = doquery("SELECT * FROM {{table}} WHERE subasta={$id}", 'pujas', false);
	$a= mysqli_fetch_assoc($resp);
	
	if(!isset($a['id']) && $results['terminado']==1)
		$tsinpujar=1;
	else 
		$tsinpujar=0;
	$results['logueado']=0;
	if(estoy_logeado())
		$results['logueado']=1;
	
	
	$smarty -> assign('IS_CONTENT', false);
	$smarty ->assign('terminadosinpujar', $tsinpujar);
	$smarty -> assign('res', $results);
	$smarty -> assign('scripts', array("visualizarProducto.js", "jquery.nivo.slider.pack.js"));
	$smarty -> assign('css', array("nivo-slider.css", "themes/default/default.css", "subasta.css"));
	$smarty -> display('visualizarProducto.tpl');

/*Caso en que se ha realizado una puja
 * parámentros: 
 * id = id del producto
 * puja = cantidad de puja
 * 
 */
} else if (isset($_POST['id']) && isset($_POST['puja'])) {
	if (isset($_SESSION['USUARIO'])) {
		$userID = userId();
		$id = $_POST['id'];
		$puja = $_POST['puja'];
		$fields = '`id`, `subasta`, `puntos`, `usuario`, `fecha`';
		$hoy = time();
		$values = "NULL, " . $id . ", " . $puja . "," . $userID . "," . $hoy ;
		$UsrP = doquery("SELECT PuntosSubasta FROM {{table}} WHERE id = {$userID}", 'usuarios', false);
		$UsrPoints = mysqli_fetch_assoc($UsrP);
		$PuntoSubasta = (double)$UsrPoints['PuntosSubasta'];
		if ($puja > $PuntoSubasta) {
			sendAjaxData(array('msg' => "No tiene puntos suficientes, por favor recargue más puntos.", 'url' => "RecargaPuntos.php"));
		} else {
			//$mPuja = doquery("SELECT max(`puntos`) FROM {{table}} WHERE `subasta` = '{$id}'", 'pujas', false);
			$mPuja = doquery("SELECT puntos FROM {{table}} WHERE subasta={$id} AND puntos = (SELECT MAX(puntos) FROM {{table}} WHERE subasta={$id})", 'pujas', false);
			$mayorPuja = mysqli_fetch_assoc($mPuja);
			//$mayorPuj=$mayorPuja['max(`puntos`)'];
			$mayorPuj = $mayorPuja['puntos'];
			if ($puja <= $mayorPuj) {
				sendAjaxData(array('msg' => "Debe pujar más puntos que la mayor puja: {$mayorPuj}.", 'url' => "visualizarProducto.php?id={$id}"));
			} else {
				$res = doquery("INSERT INTO {{table}} ({$fields}) VALUES ({$values})", 'pujas');
				if ($res) {//Registro correcto
					$PuntoSubasta = $PuntoSubasta - $puja;
					$puntos = doquery("UPDATE {{table}} SET `PuntosSubasta`='{$PuntoSubasta}' WHERE id={$userID}", 'usuarios');
					if ($puntos) {
						$durac = doquery("SELECT duracion FROM {{table}} WHERE id = {$id}", 'subastas', false);
						$duracion = mysqli_fetch_assoc($durac);

						$newDurac = $duracion['duracion'] + 60;
						$upDurac = doquery("UPDATE {{table}} SET `duracion`='{$newDurac}',`pujado`='1' WHERE id={$id}", 'subastas');
						if ($upDurac) {
							sendAjaxData(array('msg' => "Puja realizado correctamente.", 'url' => "visualizarProducto.php?id={$id}"));
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
/*
 * Función que obtiene los datos necesarios para visualizar un producto
 */
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
		$results['terminado'] = $datosProd['terminado'];
	}
	if ($results['pujado'] == 1) {
		//$res = doquery("SELECT max(puntos) FROM {{table}} WHERE 'subasta' = {$id}", 'pujas', false);
		$res = doquery("SELECT * FROM {{table}} WHERE subasta={$id} AND puntos = (SELECT MAX(puntos) FROM {{table}} WHERE subasta={$id})", 'pujas', false);
		while ($resultado = mysqli_fetch_assoc($res)) {

			$results['usrID'] = $resultado['usuario'];
			$results['puntos'] = $resultado['puntos'];
			$results['subasta'] = $resultado['subasta'];
		}

		$nomUsr = doquery("SELECT username FROM {{table}} WHERE id = {$results['usrID']}", 'usuarios', false);
		$nameUsr = mysqli_fetch_assoc($nomUsr);
		$results['usuario'] = $nameUsr['username'];
		
		$saldoMio = doquery("SELECT PuntosSubasta FROM {{table}} WHERE id = ".userId(), 'usuarios', false);
		$saldo = mysqli_fetch_assoc($saldoMio);
		$results['saldo'] = $saldo['PuntosSubasta'];
		
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
	$results['id'] = $id;

	return $results;
}
?>
