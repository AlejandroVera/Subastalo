<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);
//Cargamos el Core
require (IS2_ROOT_PATH . "core.php");

$idFrom = secure_text_query($_POST['idFrom']);
$idTo = secure_text_query($_POST['idTo']);
$cuerpo = secure_text_query($_POST['cuerpo']);
$asunto = secure_text_query($_POST['asunto']);
$ahora = time();

$addMsg = doquery("INSERT INTO {{table}} (`idFrom`, `idTo`, `asunto`, `texto`, `fecha`) VALUES ({$idFrom},{$idTo},'".$asunto."','".$cuerpo."',{$ahora})", 'mensajes');
