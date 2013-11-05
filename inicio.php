<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Load core
require(IS2_ROOT_PATH . "core.php");
$smarty -> assign('scripts', array("inicio.js"));
$smarty -> display('inicio.tpl');
?>