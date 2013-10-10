<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 3);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");


if(isset($_GET['confirmar'])){
    
    if(!isset($_POST['email']))
        echo "Falta el email.";
        
    if(!isset($_POST['password']))
        echo "Falta la contraseña.";
    
    $email = secure_text_query(strtolower($_POST['email']));
    $password = sha1($_POST['password']);
    
    $em =  doquery("UPDATE {{table}} SET confirmado = '1' WHERE email LIKE '{$email}' AND password = '{$password}' LIMIT 1", 'usuarios');
    
    if($em){
        //Inicializamos la gestión de sesiones
        session_start();
        
        //Modificamos la sesion para indicar que está logueado
        $_SESSION['logueado'] = true;
        
        //Redirigimos a la página correspondiente una vez "logueados" (index.php??)
        header('Location: index.php');
    }else{
        echo "Datos incorrectos.";
    }
    
    
}else{
    $smarty->display('confirmar.tpl');
}


?>