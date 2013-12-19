<?php

define('IS2_ROOT_PATH', '../');
define('NEEDED_ACCESS_LEVEL', 2);

//Cargamos el core
require (IS2_ROOT_PATH . "core.php");
$id=userId();
$dat = doquery("SELECT count(*) as total FROM {{table}} WHERE idTo='{$id}' AND leido=0", 'mensajes', true);
$numMsg= $dat['total'];
$smarty -> assign('aceptaMsg', aceptaMensajes(userId()));
$smarty -> assign('nivelAcceso', estoy_logeado());
$smarty -> assign('nombreUsuario', userName());
$smarty -> assign('numMensajes', $numMsg);
$smarty -> display('admin/index.tpl');
?>