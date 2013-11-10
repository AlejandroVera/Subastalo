<?php

// put full path to Smarty.class.php
require(IS2_ROOT_PATH.'/libs/Smarty/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir(IS2_ROOT_PATH.'smarty-data/templates');
$smarty->setCompileDir(IS2_ROOT_PATH.'smarty-data/templates_c');
$smarty->setCacheDir(IS2_ROOT_PATH.'smarty-data/cache');
$smarty->setConfigDir(IS2_ROOT_PATH.'smarty-data/configs');

$smarty->assign('IS2_ROOT_PATH', IS2_ROOT_PATH);

//Indica si la página se debe considerar como contenido y meterla por tanto en un globalContainer
$smarty->assign('IS_CONTENT', true); 

//Indica si la pagina actual requiere red administrador
$smarty->assign('IN_ADMIN', NEEDED_ACCESS_LEVEL >= 2);

//Indica si la pagina actual requiere red administrador
$smarty->assign('USER_ACCESS_LEVEL', estoy_logeado());


?>