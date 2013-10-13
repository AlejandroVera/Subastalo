<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 3);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");


if(isset($_GET['confirmar'])){
    
    $errorHtml = "";    
    if(!isset($_POST['email']))
        $errorHtml .= "<div>Falta el email.</div>";
        
    if(!isset($_POST['password']))
        $errorHtml .= "<div>Falta la contraseña.</div>";
    
    if($errorHtml != "")
        sendAjaxData(array('msg' => $errorHtml), 400);
        
    //Filtramos los datos
    $email = secure_text_query(strtolower($_POST['email']));
    $password = $_POST['password'];
    
    //Lo intentamos loguear con los datos proporcionados
    $valid = login($email, $password);
    
    if($valid){
        $user_id = $_SESSION['USUARIO']['id'];
        $em =  doquery("UPDATE {{table}} SET confirmado = '1' WHERE id = '{$user_id}' LIMIT 1", 'usuarios');
        
        //Redirigimos a la página correspondiente una vez "logueados"
        sendAjaxData(array('msg' => "Tu cuenta ha sido confirmada correctamente.", 'url' => 'index.php'));
    }else{
        sendAjaxData(array('msg' => "Datos incorrectos."), 400);
    }
    
    
}else{
    $smarty->assign('scripts', array("confirmar.js"));
    $smarty->display('confirmar.tpl');
}

function sendAjaxData($data, $statusCode = 200){
    $data['status'] = $statusCode;
    echo json_encode($data);
    die();
}


?>