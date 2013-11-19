<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Load core
require(IS2_ROOT_PATH . "core.php");
$smarty -> assign('scripts', array("inicio.js"));
$smarty -> assign('nivelAcceso', estoy_logeado());
$smarty -> assign('nombreUsuario', userName());
$smarty -> assign('IS_CONTENT', false);
$smarty -> display('inicio.tpl');
?>