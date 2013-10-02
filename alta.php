<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

//Procesado del formulario
if(isset($_GET['validate'])){
    $res = doquery("SHOW PROCESSLIST", "");
    die("Not implemented!!");
    
}else{ //Mostrar el formulario
    
    //$smarty->assign('name', 'Ned');
    $smarty->display('alta.tpl');
}


?>