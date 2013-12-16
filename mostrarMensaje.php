<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);
//Cargamos el Core
require (IS2_ROOT_PATH . "core.php");

$id = secure_text_query($_POST['id']);
$res = doquery("SELECT texto,asunto,leido FROM {{table}} WHERE idMensaje='{$id}'", 'mensajes', false);
$resultado = mysqli_fetch_assoc($res);
if($resultado['leido']==0){
	$res = doquery("UPDATE {{table}} SET `leido`=1 WHERE idMensaje='{$id}'", 'mensajes');
}

sendAjaxData(array('asunto' => "".$resultado['asunto'], 'cuerpo' => "".$resultado['texto']));
