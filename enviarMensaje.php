<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);
//Cargamos el Core
require (IS2_ROOT_PATH . "core.php");

$idTo = secure_text_query($_POST['idTo']);
$res = doquery("SELECT aceptaMensajes FROM {{table}} WHERE id='{$idTo}'", 'usuarios', false);
$recibeMensajes = mysqli_fetch_assoc($res);
if (!$recibeMensajes['aceptaMensajes']) {
	sendAjaxData(array('msg' => "Este usuario tiene deshabilitado los mensajes privados", 'aceptado' => "no"));

} else {
	$idFrom = secure_text_query($_POST['idFrom']);
	$cuerpo = secure_text_query($_POST['cuerpo']);
	$asunto = secure_text_query($_POST['asunto']);
	$ahora = time();

	$addMsg = doquery("INSERT INTO {{table}} (`idFrom`, `idTo`, `asunto`, `texto`, `fecha`) VALUES ({$idFrom},{$idTo},'" . $asunto . "','" . $cuerpo . "',{$ahora})", 'mensajes');
		sendAjaxData(array('msg' => "Su mensaje se ha enviado correctamente", 'aceptado' => "si"));
	
}
