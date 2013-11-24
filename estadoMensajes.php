<?php

define('IS2_ROOT_PATH', './');
//Cargamos el Core
require (IS2_ROOT_PATH . "core.php");

if ($_POST['estado'] == "d")
	$res = doquery("UPDATE {{table}} SET `aceptaMensajes`=0 WHERE `id` ={$_POST['usuario']}", 'usuarios');

else if ($_POST['estado'] == "a")
	$res = doquery("UPDATE {{table}} SET `aceptaMensajes`=1 WHERE `id` ={$_POST['usuario']}", 'usuarios');
?>
