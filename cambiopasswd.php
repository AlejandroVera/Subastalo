<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

//Cargamos la función de envío de emails y validaciones
require(IS2_ROOT_PATH . "includes/mail.php");
require(IS2_ROOT_PATH . "includes/validate.php");
$username='Wei';

if(isset($_GET['validate'])){
		
	$datos=validaContraseña();	
	if(empty($datos['error'])){
        $fields = 'password='."'{$datos['password']}'";
		     $res = doquery("UPDATE {{table}} SET {$fields} WHERE username='{$username}'", 'usuarios');
        
        if($res){ //cambio correcto
            $asunto = 'Cambio de contraseña';
            $msg = "Se ha modificado su contraseña, si no ha sido usted quien lo ha modificado póngase en contacto con el administrador.";
            $sendStatus = sendMail($datos['email'], $asunto, $msg);
            if(!$sendStatus){
                sendAjaxData(array('msg' => "No se ha podido enviar el correo de confirmación."), 400);
            }
            sendAjaxData(array(
                'msg' => "El cambio de contraseña se ha realizado correctamente. Se le ha enviado un correo para comunicarle sobre el cambio.",
                'url' => "index.php"
            ));
               
        }else{ //Fallo en el cambio
            sendAjaxData(array('msg' => "Se ha producido un error en el registro."), 400);
        }
    }
    else{
        $errorHtml = "";
        foreach ($datos['error'] as $error) {
            $errorHtml .= "<div>{$error}</div>";
        }
        sendAjaxData(array('msg' => $errorHtml), 400);
    }
}
else{
	$us =  doquery("SELECT nombre FROM {{table}} WHERE username = '{$username}' LIMIT 1", 'usuarios', false);
	$res=mysqli_fetch_assoc($us);
	$nombre=$res['nombre'];
	$smarty->assign('nombre',$nombre);
	$smarty->assign('scripts', array("cambiopasswd.js"));
    $smarty->display('cambiopasswd.tpl');	

}

function validaContraseña($username='Wei'){
	
	$retArray = array();
    $retArray['error'] = array();
     //Contraseña
    $us =  doquery("SELECT password,email FROM {{table}} WHERE username = '{$username}' LIMIT 1", 'usuarios', false);
	$res=mysqli_fetch_assoc($us);
	$passwd=$res['password'];
	$retArray['email']=$res['email'];
    if(isset($_POST['oldpassword']) && sha1($_POST['oldpassword']) == $passwd){ 
    	  
    	if(isset($_POST['password']) && isset($_POST['pass_check']) && $_POST['password'] == $_POST['pass_check']){
        	if(isValidPass($_POST['password']))
           		$retArray['password'] = sha1($_POST['password']);
        	else
           		$retArray['error'][] = 'La contraseña debe tener al menos un número y un carácter especial y no tener menos de 6 caracteres'; 
        
    	}else if($_POST['password'] != $_POST['pass_check'])
        	$retArray['error'][] = 'Las contraseñas no son iguales';
    	else
        	$retArray['error'][] = 'Falta "Contraseña"';
	}
	else {
		$retArray['error'][] = 'La contraseña antigua introducida no es correcta.';
	}


}

?>