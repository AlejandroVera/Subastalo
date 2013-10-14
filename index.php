<?php

define('IS2_ROOT_PATH', './');

//Load core
require(IS2_ROOT_PATH . "core.php");
$smarty -> assign('nivelAcceso', estoy_logeado());
$smarty -> assign('scripts', array("log.js"));
$smarty -> display('index.tpl');
?>