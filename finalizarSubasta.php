<?php

define('IS2_ROOT_PATH', './');
//Cargamos el Core
require (IS2_ROOT_PATH . "core.php");

$upDurac = doquery("UPDATE {{table}} SET `terminado`='1' WHERE id=" . $_POST['idF'], 'subastas');
?>
