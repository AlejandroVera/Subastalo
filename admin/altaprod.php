<?php

define('IS2_ROOT_PATH', '../');
define('NEEDED_ACCESS_LEVEL', 2);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

if(isset($_GET['create'])){
    
    var_dump($_FILES);
    var_dump($_POST);
    var_dump($_GET);
    
}else{
    $smarty->assign('scripts', array("admin/altaprod.js"));
    $smarty->display('admin/altaprod.tpl');
}


?>