<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

//Cargamos la función de envío de emails
require(IS2_ROOT_PATH . "includes/mail.php");

//Procesado del formulario
if(isset($_GET['validate'])){
    
    $datos = validaFormularioAlta();
    
    if(empty($datos['error'])){
        $fields = '';
        $values = '';
        foreach ($datos as $key => $value) {
            if($key == 'error')
                continue;
            
            $fields .= $key.',';
            $values .= "'{$value}',";
        }
        
        $fields[strlen($fields)-1] = '';
        $values[strlen($values)-1] = '';
        
        //Registramos al usuario
        $res = doquery("INSERT INTO {{table}} ({$fields}) VALUES ({$values})", 'usuarios');
        
        if($res){ //Registro correcto
            $sendStatus = sendMail($datos['email'], 'Activación de cuenta', 'Necesitarás activar tu cuenta. Funcionalidad aun no disponible.');
            if(!$sendStatus){
                //TODO: mostrar mensaje con el error
            }
        }else{ //Fallo en el registro
            //TODO: mostrar mensaje con el error
        }
    }else{
        //TODO: mostrar mensaje con el error
    }
    
    die("Not implemented!!");
    
}else{ //Mostrar el formulario
    
    //$smarty->assign('name', 'Ned');
    $smarty->display('alta.tpl');
}


function validaFormularioAlta(){
    $retArray = array();
    $retArray['error'] = array();
    
    //Nombre usuario
    if(isset($_POST['nombre_usuario']))
        $retArray['nombre_usuario'] = secure_text_query($_POST['nombre_usuario']);
    else
        $retArray['error'][] = 'Falta "Nombre usuario"';
    
    //Nombre
    if(isset($_POST['nombre']))
        $retArray['nombre'] = secure_text_query($_POST['nombre']);
    else
        $retArray['error'][] = 'Falta "Nombre"';
    
    //Apellidos
    if(isset($_POST['apellidos']))
        $retArray['apellidos'] = secure_text_query($_POST['apellidos']);
    else
        $retArray['error'][] = 'Falta "Apellidos"';
    
    //Direccion
    if(isset($_POST['direccion']))
        $retArray['direccion'] = secure_text_query($_POST['direccion']);
    else
        $retArray['error'][] = 'Falta "Direccion"';
    
    //Código postal
    if(isset($_POST['cod_postal']))
        $retArray['cod_postal'] = secure_text_query($_POST['cod_postal']);
    else
        $retArray['error'][] = 'Falta "Código postal"';
        
    //Ciudad
    if(isset($_POST['ciudad']))
        $retArray['ciudad'] = secure_text_query($_POST['ciudad']);
    else
        $retArray['error'][] = 'Falta "Ciudad"';
    
    //Fecha nacimiento
    if(isset($_POST['fecha_nacimiento']))
        $retArray['fecha_nacimiento'] = secure_text_query($_POST['fecha_nacimiento']);
    else
        $retArray['error'][] = 'Falta "Fecha nacimiento"';
    
    //Teléfono
    if(isset($_POST['telefono']))
        $retArray['telefono'] = secure_text_query($_POST['telefono']);
    else
        $retArray['error'][] = 'Falta "Teléfono"';
    
    //Email
    if(isset($_POST['email']) && isset($_POST['email_check']) && $_POST['email'] == $_POST['email_check']){
        if(isValidEmail($_POST['email']))
            $retArray['email'] = secure_text_query($_POST['email']);
        else
            $retArray['error'][] = 'El email no sigue un formato válido';
    }else
        $retArray['error'][] = 'Falta "Email"';
    
    //Contraseña
    if(isset($_POST['pass']) && isset($_POST['pass_check']) && $_POST['pass'] == $_POST['pass_check']){
        if(isValidPass($_POST['pass']))
            $retArray['pass'] = sha1($_POST['pass']);
        else
           $retArray['error'][] = 'La contraseña debe tener al menos un número y un carácter especial y no tener menos de 6 caracteres'; 
        
    }else
        $retArray['error'][] = 'Falta "Contraseña"';
    
    //Comprobar que no existe el nombre de usuario ni el email
    if(isset($retArray['nombre_usuario'])){
        $us =  doquery("SELECT username FROM {{table}} WHERE username = '{$retArray['nombre_usuario']}' LIMIT 1", 'usuarios', true);
        if($us != NULL)
            $retArray['error'][] = 'El nombre de usuario ya existe';
    }
    
    if(isset($retArray['email'])){
        $em =  doquery("SELECT email FROM {{table}} WHERE email = '{$retArray['email']}' LIMIT 1", 'usuarios', true);
        if($em != NULL)
            $retArray['error'][] = 'El email ya existe';
    }
    
    
    return $retArray;
    
    
}

//Contraseña debe tener al menos un número y un carácter especial y no tener menos de 6 caracteres
function isValidPass($pass){
    return strlen($pass) >= 6 && preg_match("#[0-9]+#", $pass) && preg_match("#\W+#", $pass);
}

function isValidEmail($email){
    return !!filter_var($email, FILTER_VALIDATE_EMAIL); 
}


?>