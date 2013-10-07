<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

//Cargamos la función de envío de emails
require(IS2_ROOT_PATH . "includes/validate.php");

$username=secure_text_query("Wei");

//Procesado del formulario
if(isset($_GET['validate'])){
		
	$datos=validaEdicionPerfil();	
	
	
	    if(empty($datos['error'])){
        $fields = '';
        $values = '';
        foreach ($datos as $key => $value) {
            if($key == 'error')
                continue;
 
            $fields .= $key.'='.$value.',';
        }
        
        //Sustituir la ultima coma por un espacio
        $fields[strlen($fields)-1] = ' ';
 
        //Modificamos las tablas de usuario
        $res = doquery("UPDATE {{table}} SET {$fields} WHERE username='{$username}'", 'usuarios');
        
        if($res){ //Modificacion correcta
        	$smarty->assign('scripts', array("alta.js"));
            sendAjaxData(array(
                'msg' => "Se ha realizado Modificación de perfil correctamente."
            ));
               
        }else{ //Fallo en la edicion
            sendAjaxData(array('msg' => "Se ha producido un error en la edición de perfil."), 400);
        }
    }else{
        $errorHtml = "";
        foreach ($datos['error'] as $error) {
            $errorHtml .= "<div>{$error}</div>";
        }
        sendAjaxData(array('msg' => $errorHtml), 400);
    }
}
else{
	$res=doquery("SELECT * FROM {{table}} WHERE username = '{$username}' LIMIT 1",'usuarios',false);
	$result=array();
	while ($resultado = mysqli_fetch_assoc($res)) {
			
		$results['nombre'] = $resultado['nombre'];
		$results['apellidos'] = $resultado['apellidos'];
		$results['direccion'] = $resultado['direccion'];
		$results['cod_postal'] = $resultado['cod_postal'];
		$results['ciudad'] = $resultado['ciudad'];
		$results['pais'] = $resultado['pais'];
		$results['fecha_nacimiento'] = $resultado['fecha_nacimiento'];
		$results['telefono'] = $resultado['telefono'];
		$results['email'] = $resultado['email'];
	}
	$smarty->assign('res', $results);
    $smarty->display('editarPerfil.tpl');	
}

function validaEdicionPerfil(){
    $retArray = array();
    $retArray['error'] = array();
    

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
    if(isset($_POST['email'])){
        if(isValidEmail($_POST['email']))
                $retArray['email'] = secure_text_query(strtolower($_POST['email']));
            else
                $retArray['error'][] = 'El email no sigue un formato válido';
        }else
        $retArray['error'][] = 'Falta "Email"';
    
   
    return $retArray;
}
function sendAjaxData($data, $statusCode = 200){
    $data['status'] = $statusCode;
    echo json_encode($data);
}
?>
 