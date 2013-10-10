<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

//Cargamos las función de validaciones
require(IS2_ROOT_PATH . "includes/validate.php");

$smarty->assign('scripts', array("mensajePrivado.js"));
 $smarty->display('perfil.tpl');	
?>
