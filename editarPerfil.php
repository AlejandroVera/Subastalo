<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 0);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

//Cargamos las función de validaciones
require(IS2_ROOT_PATH . "includes/validate.php");

$id=secure_text_query("27");

//Procesado del formulario
if(isset($_GET['validate'])){
		
	$datos=validaEdicionPerfil();	
	if(empty($datos['error'])){
        $fields = '';
        $values = '';
        foreach ($datos as $key => $value) {
            if($key == 'error')
                continue;
 
            $fields .= $key.'='."'{$value}',";
        }
        //Sustituir la ultima coma por un espacio
        $fields[strlen($fields)-1] = ' ';
        //Modificamos las tablas de usuario
        $res = doquery("UPDATE {{table}} SET {$fields} WHERE id='{$id}'", 'usuarios');
        
        if($res){ //Modificacion correcta
        	
            sendAjaxData(array(
                'msg' => "Se ha realizado modificación de perfil correctamente.",
           		'url' => "index.php"
            ));
               
        }else{ //Fallo en la edicion
            sendAjaxData(array('msg' => "Se ha producido un error en la edición de perfil."), 400);
        }
		$lista=$_POST['lista'];
        $field = '';
        foreach ($lista as $key => $value) 
            $field .= "`{$value}`=1,";

        //Sustituir la ultima coma por un espacio
        $field[strlen($field)-1] = ' ';
 
        //Modificamos las tablas de usuario
        $reslist = doquery("UPDATE {{table}} SET {$field} WHERE idUsuario='{$id}'", 'listaIntereses');
        if(!$reslist)
			 sendAjaxData(array('msg' => "Se ha producido un error en la actualización de lista de intereses."), 400);
      
		
    }else{
        $errorHtml = "";
        foreach ($datos['error'] as $error) {
            $errorHtml .= "<div>{$error}</div>";
        }
        sendAjaxData(array('msg' => $errorHtml), 400);
    }
}
else{
	//Se obtiene todos los datos del usuario creados en el alta
	$res=doquery("SELECT * FROM {{table}} WHERE id = '{$id}' LIMIT 1",'usuarios',false);
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
	//Se obtiene todos los productos de la lista con la idUsuario
	$listaquery=doquery("SELECT * FROM {{table}} WHERE idUsuario = '{$id}' LIMIT 1",'listaIntereses',false);
	while($listares = mysqli_fetch_assoc($listaquery)){
			
		$lista['Joyeria y Belleza']=$listares['Joyeria y Belleza'];
		$lista['Electronica']=$listares['Electronica'];
		$lista['Hogar y Decoracion']=$listares['Hogar y Decoracion'];
		$lista['Entretenimiento']=$listares['Entretenimiento'];
		$lista['Deportes y Tiempo Libre']=$listares['Deportes y Tiempo Libre'];
		$lista['Coleccionismo y Arte']=$listares['Coleccionismo y Arte'];
		$lista['Motor']=$listares['Motor'];
	}
	//Se pasa la lista de checkbox, los datos de perfil, el tpl y el fichero js
	$smarty->assign('lista',$lista);
	$smarty->assign('scripts', array("edicionPerfil.js"));
	$smarty->assign('res', $results);
    $smarty->display('editarPerfil.tpl');	
}

function sendAjaxData($data, $statusCode = 200){
    $data['status'] = $statusCode;
    echo json_encode($data);
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
?>
 