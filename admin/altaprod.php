<?php

define('IS2_ROOT_PATH', '../');
define('NEEDED_ACCESS_LEVEL', 2);

//Cargamos el core
require(IS2_ROOT_PATH . "core.php");

if(isset($_GET['create'])){

    $parsed = parseRequest();
    
    if(empty($parsed['error'])){
    
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
        
        //Generamos un array con las caracteristicas
        $caracteristicas = array();
        foreach($_POST["nombreCaract"] as $id => $nombre){
            if($nombre != "" && $_POST["valorCaract"]["$id"] != ""){
                $caracteristicas[$nombre] = $_POST["valorCaract"]["$id"];
            }
        }
        
        doquery("INSERT INTO {{table}} (nombre, imagen, descripcion, comienzo, duracion, fechaCreacion) VALUES (
            '{$parsed['nombre']}', '".implode("|",$imagenes)."', '{$parsed['descripcion']}', '{$parsed['comienzo']}', '{$parsed['duracion']}', '".time()."'
        )", "subastas");
        
        //Obtener el ultimo id insertado y añadir todas las caracteristicas a la BD para ese ID.
        if(!empty($caracteristicas)){
            $id = mysqlLastInsertedId();
            if(is_numeric($id)){
                $sqlText = "INSERT INTO {{table}} (nombre, idProducto, valor) VALUES ";
                foreach($caracteristicas as $nombre => $valor){
                    $sqlText .= "('".secure_text_query($nombre)."', '$id', '".secure_text_query($valor)."'),";
                }
                $sqlText[strlen($sqlText)-1] = " "; //Borra la ultima coma
                doquery($sqlText, "caracteristicas");
                
            }else{
                sendAjaxData(array('msg' => "<div>Se ha producido un error</div>"), 400);
                exit();
            }      
        }
        
        //Terminado correctamente
        sendAjaxData(array(
            'msg' => "El producto ha sido registrado correctamente."
        ));
    
    }else{
        $errorHtml = "";
        foreach ($parsed['error'] as $error) {
            $errorHtml .= "<div>{$error}</div>";
        }
        sendAjaxData(array('msg' => $errorHtml), 400);
    }
    
    
}else{
	$id=userId();
	$dat = doquery("SELECT count(*) as total FROM {{table}} WHERE idTo='{$id}' AND leido=0", 'mensajes', true);
	$numMsg= $dat['total'];
    $smarty->assign('scripts', array("admin/altaprod.js", "jquery-ui-timepicker-addon.js"));
    $smarty->assign('css', array("jquery-ui-timepicker-addon.css", "admin/altaprod.css"));
	$smarty -> assign('aceptaMsg', aceptaMensajes(userId()));
	$smarty -> assign('nombreUsuario', userName());
	$smarty -> assign('nivelAcceso', estoy_logeado());
	$smarty -> assign('numMensajes', $numMsg);
    $smarty->display('admin/altaprod.tpl');
    
}

/*function sendAjaxData($data, $statusCode = 200){
    $data['status'] = $statusCode;
    echo json_encode($data);
}*/

function parseRequest(){
    
    $retArray = array();
    $retArray['error'] = array();
    
    //Nombre
    if(isset($_POST['nombre']) && $_POST['nombre'] != "")
        $retArray['nombre'] = secure_text_query($_POST['nombre']);
    else
        $retArray['error'][] = 'Falta "Nombre"';
    
    //Descripcion
    if(isset($_POST['descripcion']) && $_POST['descripcion'] != "")
        $retArray['descripcion'] = secure_text_query($_POST['descripcion']);
    else
        $retArray['error'][] = 'Falta "Descripcion"';
    
    if($_POST['tipo'] == "subasta"){
        //Fecha de comienzo
        if(isset($_POST['comienzo']) && $_POST['comienzo'] != "")
            if($date = DateTime::createFromFormat("m/d/Y H:i", $_POST['comienzo']))
                $retArray['comienzo'] = $date->getTimestamp();
            else {
                $retArray['error'][] = 'El Tiempo de Inicio no posee un formato válido';
            }
        else
            $retArray['error'][] = 'Falta "Tiempo de Inicio"';
            
        //Duracion
        if(isset($_POST['duracion']) && $_POST['duracion'] != "")
            $retArray['duracion'] =  (int)$_POST['duracion'] * 60; //Pasa de minutos a segundos
        else
            $retArray['error'][] = 'Falta "Duracion"';
    }else
        $retArray['error'][] = 'Falta el tipo de producto';
    
    return $retArray;
    
}


?>