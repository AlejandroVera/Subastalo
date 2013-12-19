<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);
//Cargamos el Core
require (IS2_ROOT_PATH . "core.php");

$mensajes=array();

$id=userId();

$res = doquery("SELECT idMensaje,idFrom,asunto,leido,fecha FROM {{table}} WHERE idTo='{$id}'", 'mensajes', false);
$i=0;
while ($resultado = mysqli_fetch_assoc($res)) {
	$deQ = doquery("SELECT username FROM {{table}} WHERE id={$resultado['idFrom']}", 'usuarios', false);
	$de = mysqli_fetch_assoc($deQ);
	$noLeidos[$i]=array();
	
	$mensajes[$i]['usuario']=$de['username'];
	$mensajes[$i]['titulo']=$resultado['asunto'];
	$mensajes[$i]['fecha']=date(" H:m:s d/m/Y", $resultado['fecha']);
	$mensajes[$i]['id']=$resultado['idMensaje'];
	$mensajes[$i]['leido']=$resultado['leido'];
	$mensajes[$i]['idFrom']=$resultado['idFrom'];
	$i++;
}
$id=userId();
$dat = doquery("SELECT count(*) as total FROM {{table}} WHERE idTo='{$id}' AND leido=0", 'mensajes', true);
$numMsg= $dat['total'];

$smarty -> assign('scripts', array("bandejaEntrada.js"));
$smarty -> assign('IS_CONTENT', false);
if( sizeof($mensajes) != 0 )
	$smarty -> assign('mensajes', $mensajes);
$smarty -> assign('nivelAcceso', estoy_logeado());
$smarty -> assign('nombreUsuario', userName());
$smarty -> assign('css', array("bandeja.css"));
$smarty -> assign('aceptaMsg', aceptaMensajes(userId()));
$smarty -> assign('numMensajes', $numMsg);
$smarty -> display('bandejaEntrada.tpl');