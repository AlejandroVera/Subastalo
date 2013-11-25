<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Load core
require (IS2_ROOT_PATH . "core.php");


$random = mysqli_fetch_all(doquery("SELECT * FROM {{table}} ORDER BY RAND() LIMIT 6;", "subastas"), MYSQLI_ASSOC); //No es eficiente pero sirve
$acabanAntes = mysqli_fetch_all(doquery("SELECT * FROM {{table}} WHERE comienzo+duracion > UNIX_TIMESTAMP() ORDER BY comienzo+duracion ASC LIMIT 6;", "subastas"), MYSQLI_ASSOC);
$nuevas = mysqli_fetch_all(doquery("SELECT * FROM {{table}} WHERE comienzo+duracion > UNIX_TIMESTAMP() ORDER BY comienzo DESC LIMIT 6;", "subastas"), MYSQLI_ASSOC);

for($x = 0; $x < count($random); $x++){
    $texto = $random[$x]["imagen"];
    if($texto != ""){
        $imagenes = explode("|",$texto);
        $random[$x]["imagen"] = $imagenes[0];
    }
}

for($x = 0; $x < count($acabanAntes); $x++){
    $texto = $acabanAntes[$x]["imagen"];
    if($texto != ""){
        $imagenes = explode("|",$texto);
        $acabanAntes[$x]["imagen"] = $imagenes[0];
    }
}

for($x = 0; $x < count($nuevas); $x++){
    $texto = $nuevas[$x]["imagen"];
    if($texto != ""){
        $imagenes = explode("|",$texto);
        $nuevas[$x]["imagen"] = $imagenes[0];
    }
}

$smarty -> assign('random', $random);
$smarty -> assign('acabanAntes', $acabanAntes);
$smarty -> assign('nuevas', $nuevas);

$smarty -> assign('scripts', array("inicio.js", "jquery.nivo.slider.pack.js"));
$smarty -> assign('css', array("nivo-slider.css"));
$smarty -> assign('nivelAcceso', estoy_logeado());
$smarty -> assign('nombreUsuario', userName());
$smarty -> assign('USUARIO_LOGUEADO', userId());
$smarty -> assign('IS_CONTENT', false);
$smarty -> assign('aceptaMsg', aceptaMensajes(userId()));
$smarty -> display('inicio.tpl');
?>