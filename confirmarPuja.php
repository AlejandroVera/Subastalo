<?php
define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);
//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

$userID=userId();
if(isset($_SESSION['USUARIO']) && isset($_GET['idProducto'])){

	if(isset($_GET['puja'])){
		
		$fields = '`id`, `subasta`, `puntos`, `usuario`, `fecha`, `ganada`';
     	$hoy=time();
     	$values = "NULL, ".$_GET['idProducto'].", ".$_GET['puja']. ",". $userID."," .$hoy. ", '0'";
        $UsrP = doquery("SELECT PuntosSubasta FROM {{table}} WHERE id = {$userID}", 'usuarios', false);	
		$UsrPoints=mysqli_fetch_assoc($UsrP);
		$PuntoSubasta=(double)$UsrPoints['PuntosSubasta'];
		if($_GET['puja']>$PuntoSubasta){
			sendAjaxData(array(
                'msg' => "No tiene puntos suficientes, por favor recargue más puntos.",
                'url' => "RecargaPuntos.php"));	 
		}
		else {
			$mPuja = doquery("SELECT puntos FROM {{table}} WHERE subasta IN (SELECT MAX({$_GET['idProducto']}) FROM {{table}})", 'pujas', false);
			$mayorPuja=mysqli_fetch_assoc($mPuja);
			$mayorPuj=(double)$mayorPuja['puntos'];
			if($_GET['puja']<$mayorPuj){
				sendAjaxData(array(
	                'msg' => "Debe pujar mas puntos que la mayor puja: {$mayorPuj}."));	
			}
			else{
				$res = doquery("INSERT INTO {{table}} ({$fields}) VALUES ({$values})", 'pujas');
	        	if($res){ //Registro correcto
	        		$PuntoSubasta=$PuntoSubasta-$_GET['puja'];
	        		$puntos = doquery("UPDATE {{table}} SET `PuntosSubasta`='{$PuntoSubasta}' WHERE id={$userID}", 'usuarios');
        			if($puntos){
        				sendAjaxData(array(
	             	   'msg' => "Puja realizado correctamente.",
						'url' => "index.php"));	
        			}
				}
			}
		}
	}
	else {
		$smarty-> assign('idProducto',$_GET['idProducto']);
		$smarty-> assign('IS_CONTENT', false);
		$smarty-> assign('scripts', array("confirmarPuja.js"));
		$smarty-> display('confirmarPuja.tpl');
		}
}
else{
	 sendAjaxData(array(
                'msg' => "No esta en sesion, loguease con una cuenta para poder pujar.",
				'url' => "index.php"));	 
}
	


?>