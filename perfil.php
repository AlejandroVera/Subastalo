<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

//Cargamos las función de validaciones
require (IS2_ROOT_PATH . "includes/validate.php");

if (isset($_SESSION['USUARIOS']['id']))
	$usuarioEstePerfil = $_SESSION['USUARIOS']['id'];


//TODO:
//$res = doquery("SELECT aceptaMensajes FROM {{table}} WHERE id = '{$usuarioEstePerfil}'", 'usuarios');
//$muestraBotonMsg = mysqli_fetch_assoc($res);
$muestraBotonMsg['aceptaMensajes']=1;
$idPerfil=2;
//$usuarioLogueado=$_SESSION['USUARIO']['id'];
$usuarioLogueado=1;

$smarty -> assign('muestraBotonMsg', $muestraBotonMsg['aceptaMensajes']);
$smarty -> assign('scripts', array("mensajePrivado.js"));
$smarty -> assign('idPerfil', $idPerfil);
$smarty -> assign('usuarioLogueado', $usuarioLogueado); 
$smarty -> display('perfil.tpl');
?>
