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
	
	$mensajes[$i]['datos']="FECHA: ". date(" H:m:s d/m/Y", $resultado['fecha'])."   ASUNTO: ".$resultado['asunto']."    DE USUARIO: ".$de['username'];
	$mensajes[$i]['id']=$resultado['idMensaje'];
	$mensajes[$i]['leido']=$resultado['leido'];
	$i++;
}
$id=userId();
$dat = doquery("SELECT count(*) as total FROM {{table}} WHERE idTo='{$id}' AND leido=0", 'mensajes', true);
$numMsg= $dat['total'];

$smarty -> assign('scripts', array("bandejaEntrada.js"));
$smarty -> assign('IS_CONTENT', false);
if( sizeof($noLeidos) != 0 )
	$smarty -> assign('mensajes', $mensajes);
$smarty -> assign('nivelAcceso', estoy_logeado());
$smarty -> assign('nombreUsuario', userName());
$smarty -> assign('aceptaMsg', aceptaMensajes(userId()));
$smarty -> assign('numMensajes', $numMsg);
$smarty -> display('bandejaEntrada.tpl');