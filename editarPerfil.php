<?php

define('IS2_ROOT_PATH', './');
define('NEEDED_ACCESS_LEVEL', 1);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

//Cargamos las función de validaciones
require(IS2_ROOT_PATH . "includes/validate.php");

$id=secure_text_query(userId());
$listaquery=doquery("SELECT * FROM {{table}} WHERE idUsuario = '{$id}' LIMIT 1",'listaIntereses',false);
$listares = mysqli_fetch_assoc($listaquery);

//Procesado del formulario
if(isset($_GET['validate'])){
	
	
	$imagenes = array();
	foreach ($_FILES as $nombre => $file) {
            if(strpos($nombre, "imagen") === 0){ //Si empiezan por "imagen" las acepto
                if ($file['error'] == UPLOAD_ERR_OK) {
                    
                    //Get extension
                    $separado = explode(".", $file['name']);
                    $extension = "";
                    if(count($separado) > 1){
                        $extension = $separado[count($separado) - 1];
                    }
                    
                    //Nombre final del archivo
                    $name = uniqid().".".$extension;
    
                    //La movemos al destino final
                    move_uploaded_file($file['tmp_name'], IS2_ROOT_PATH."images/uploaded/$name");
                    
                    //Lo agregamos al array para porteriormente meterlo en la BD
                    $imagenes[] = $name;
                }
                
            }
        }
	$images=implode("|",$imagenes);
	
	
	
	
	$datos=validaEdicionPerfil();	
	if(empty($datos['error'])){
        $fields = '';
        $values = '';
        foreach ($datos as $key => $value) {
            if($key == 'error')
                continue;
 
            $fields .= $key.'='."'{$value}',";
        }
        //Añadir la imagen a los parametros
        $fields.= "imagenPerfil='{$images}'";
        //Modificamos las tablas de usuario
        $res = doquery("UPDATE {{table}} SET {$fields} WHERE id='{$id}'", 'usuarios');
        
        if($res){ //Modificacion correcta
        	
            sendAjaxData(array(
                'msg' => "Se ha realizado modificación de perfil correctamente.",
           		'url' => "index.php"
            ));
               
        }else //Fallo en la edicion
            sendAjaxData(array('msg' => "Se ha producido un error en la edición de perfil."), 400);
        
		//Codigo lista de intereses
        $field = '';
		//bucle que asigna valor 1 a los campos seleccionados
		foreach ($listares as $key => $value) {
			if($key == 'idUsuario')
                continue;
			if(isset($_POST[$key]))
				$field .= "`{$key}` = '1',";
			else 
				$field .= "`{$key}` = '0',";
		}
      
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
else if(estoy_logeado()){
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
		$results['productosInteresados']=$resultado['productosInteresados'];
	}
	//Se crea una lista para pasarselo al template
	$lista['Joyeria y Belleza']=$listares['Joyeria y Belleza'];
	$lista['Electronica']=$listares['Electronica'];
	$lista['Hogar y Decoracion']=$listares['Hogar y Decoracion'];
	$lista['Entretenimiento']=$listares['Entretenimiento'];
	$lista['Deportes y Tiempo Libre']=$listares['Deportes y Tiempo Libre'];
	$lista['Coleccionismo y Arte']=$listares['Coleccionismo y Arte'];
	$lista['Motor']=$listares['Motor'];

	//Se pasa la lista de checkbox, los datos de perfil, el tpl y el fichero js
	
	$smarty -> assign('IS_CONTENT', false);
	$smarty->assign('scripts', array("edicionPerfil.js"));
	$smarty->assign('res', $results);
	$smarty->assign('lista',$lista);
    $smarty->display('editarPerfil.tpl');	
}
else{
	sendAjaxData(array('msg' => "No está logueado.Debe loguearse para editar su perfil."), 400);
   
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
	if(isset($_POST['productosInteresados']))
        $retArray['productosInteresados'] = secure_text_query($_POST['productosInteresados']);
    return $retArray;
}
?>
 