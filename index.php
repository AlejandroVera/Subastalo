<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Load core
require(IS2_ROOT_PATH . "core.php");
$smarty -> assign('nivelAcceso', estoy_logeado());
$smarty -> assign('scripts', array("main.js"));
$smarty -> display('index.tpl');
?>