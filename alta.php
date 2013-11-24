<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el Core
require(IS2_ROOT_PATH . "core.php");

//Cargamos la función de envío de emails
require(IS2_ROOT_PATH . "includes/mail.php");

//Cargamos ciertas funciones de validacion
require(IS2_ROOT_PATH . "includes/validate.php");

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
        
        //Sustituir la ultima coma por un espacio
        $fields[strlen($fields)-1] = ' ';
        $values[strlen($values)-1] = ' ';
        
        //Registramos al usuario
        $res = doquery("INSERT INTO {{table}} ({$fields}) VALUES ({$values})", 'usuarios');
        
        if($res){ //Registro correcto
        
        	//Codigo para crear una lista de productos con el idUsuario
			$usrname=secure_text_query($_POST['username']);
        	$obtId=doquery("SELECT id FROM {{table}} WHERE username = '{$usrname}'", 'usuarios');
        	if(!$obtId)
				sendAjaxData(array('msg' => "Error al obtener id"),400);
        	$ResId=mysqli_fetch_assoc($obtId);
			$idUser=$ResId['id'];
        	$addlist=doquery("INSERT INTO {{table}} (`idUsuario`) VALUES ({$idUser})", 'listaIntereses');
      		if(!$addlist)
				sendAjaxData(array('msg' => "Error al crear tabla de lista"),400);	
            //Fin codigo de crear lista
            
            $asunto = 'Activación de cuenta';
            $msg = "Necesitarás activar tu cuenta accediendo al siguiente enlace: {$WEB_CONFIG['web_url']}";
            $sendStatus = sendMail($datos['email'], $asunto, $msg);
            if(!$sendStatus){
                sendAjaxData(array('msg' => "No se ha podido enviar el correo de confirmación."), 400);
            }
            
            sendAjaxData(array(
                'msg' => "El registro se ha realizado correctamente. Se le ha enviado un correo con un link de activación de cuenta.",
                'url' => "index.php"
            ));
               
        }else{ //Fallo en el registro
            sendAjaxData(array('msg' => "Se ha producido un error en el registro."), 400);
        }
    }else{
        $errorHtml = "";
        foreach ($datos['error'] as $error) {
            $errorHtml .= "<div>{$error}</div>";
        }
        sendAjaxData(array('msg' => $errorHtml), 400);
    }
    
}else{ //Mostrar el formulario
    
    //$smarty->assign('name', 'Ned');
	$smarty->assign('css',array("alta.css"));
    $smarty->assign('scripts', array("alta.js"));
    $smarty -> assign('nivelAcceso', estoy_logeado());
	$smarty -> assign('IS_CONTENT', false);
	$smarty -> assign('aceptaMsg', aceptaMensajes(userId()));
    $smarty->display('alta.tpl');
}

function validaFormularioAlta(){
    $retArray = array();
    $retArray['error'] = array();
    
    //Nombre usuario
    if(isset($_POST['username']))
        $retArray['username'] = secure_text_query($_POST['username']);
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
    
    //Pais
    if(isset($_POST['pais']))
        $retArray['pais'] = secure_text_query($_POST['pais']);
    else
        $retArray['error'][] = 'Falta "Pais"';
    
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
    if(isset($_POST['email']) && isset($_POST['email_check'])){
        if(strtolower($_POST['email']) == strtolower($_POST['email_check'])){
            if(isValidEmail($_POST['email']))
                $retArray['email'] = secure_text_query(strtolower($_POST['email']));
            else
                $retArray['error'][] = 'El email no sigue un formato válido';
        }else
            $retArray['error'][] = 'Los emails no son iguales';
    }else
        $retArray['error'][] = 'Falta "Email"';
    
    //Contraseña
    if(isset($_POST['password']) && isset($_POST['pass_check']) && $_POST['password'] == $_POST['pass_check']){
        if(isValidPass($_POST['password']))
            $retArray['password'] = sha1($_POST['password']);
        else
           $retArray['error'][] = 'La contraseña debe tener al menos un número y un carácter especial y no tener menos de 6 caracteres'; 
        
    }else if($_POST['password'] != $_POST['pass_check'])
        $retArray['error'][] = 'Las contraseñas no son iguales';
    else
        $retArray['error'][] = 'Falta "Contraseña"';
    
    //Comprobar que no existe el nombre de usuario ni el email
    if(isset($retArray['username'])){
        $us =  doquery("SELECT username FROM {{table}} WHERE username = '{$retArray['username']}' LIMIT 1", 'usuarios', true);
        if($us != NULL)
            $retArray['error'][] = 'El nombre de usuario ya existe';
    }
    
    if(isset($retArray['email'])){
        $em =  doquery("SELECT email FROM {{table}} WHERE email LIKE '{$retArray['email']}' LIMIT 1", 'usuarios', true);
        if($em != NULL)
            $retArray['error'][] = 'El email ya existe';
    }
    
    
    return $retArray;
    
    
}


?>