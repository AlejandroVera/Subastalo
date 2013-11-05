<?php

// put full path to Smarty.class.php
require(IS2_ROOT_PATH.'/libs/Smarty/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir(IS2_ROOT_PATH.'smarty-data/templates');
$smarty->setCompileDir(IS2_ROOT_PATH.'smarty-data/templates_c');
$smarty->setCacheDir(IS2_ROOT_PATH.'smarty-data/cache');
$smarty->setConfigDir(IS2_ROOT_PATH.'smarty-data/configs');

$smarty->assign('IS2_ROOT_PATH', IS2_ROOT_PATH);

?>