<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);
//Cargamos el Core
require (IS2_ROOT_PATH . "core.php");

$id = secure_text_query($_POST['id']);
$res = doquery("SELECT texto,asunto FROM {{table}} WHERE idMensaje='{$id}' AND leido=0", 'mensajes', false);
$resultado = mysqli_fetch_assoc($res);
sendAjaxData(array('asunto' => "".$resultado['asunto'], 'cuerpo' => "".$resultado['texto']));
