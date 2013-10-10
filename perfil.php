<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

//Cargamos las función de validaciones
require (IS2_ROOT_PATH . "includes/validate.php");


$usuarioEstePerfil = 26;
//TODO: Obtener el id de usuario del perfil

$res = doquery("SELECT aceptaMensajes FROM {{table}} WHERE id = '{$usuarioEstePerfil}'", 'usuarios');

$muestraBotonMsg = mysqli_fetch_assoc($res);

$smarty -> assign('muestraBotonMsg', $muestraBotonMsg['aceptaMensajes']);
$smarty -> assign('scripts', array("mensajePrivado.js"));
$smarty -> display('perfil.tpl');
?>
