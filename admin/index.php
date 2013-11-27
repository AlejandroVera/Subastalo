<?php

define('IS2_ROOT_PATH', '../');
define('NEEDED_ACCESS_LEVEL', 2);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");

$smarty -> assign('aceptaMsg', aceptaMensajes(userId()));
$smarty -> assign('nivelAcceso', estoy_logeado());
$smarty -> assign('nombreUsuario', userName());
$smarty -> display('admin/index.tpl');
?>