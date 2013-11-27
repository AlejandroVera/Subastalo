<?php

define('IS2_ROOT_PATH', './');
//Cargamos el Core
require (IS2_ROOT_PATH . "core.php");

$id = secure_text_query($_POST['idF']);

$upDurac = doquery("UPDATE {{table}} SET `terminado`='1' WHERE id=" . $id, 'subastas');
?>
