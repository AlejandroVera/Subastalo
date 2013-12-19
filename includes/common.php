<?php
/**
 * Verifica si el usuario está logeado
 * @return bool
 */
function estoy_logeado() {

	if (!isset($_SESSION['USUARIO']))
		return 0;
	//no existe la variable $_SESSION['USUARIO']. No logeado.
	if (!is_array($_SESSION['USUARIO']))
		return 0;
	//la variable no es un array $_SESSION['USUARIO']. No logeado.
	if (empty($_SESSION['USUARIO']['id']))
		return 0;
	//no tiene almacenado el usuario en $_SESSION['USUARIO']. No logeado.

	//cumple las condiciones anteriores, entonces es un usuario validado
	return $_SESSION['USUARIO']['nivel_acceso'];

}

/**
 * Devuelve el ID del usuario
 * @return int Id del usuario. Null en caso de error
 */
function userId() {
	if (!isset($_SESSION['USUARIO']) || !isset($_SESSION['USUARIO']['id']))
		return null;
	return $_SESSION['USUARIO']['id'];
}

function userName() {
	if (!isset($_SESSION['USUARIO']) || !isset($_SESSION['USUARIO']['id']))
		return null;
	return $_SESSION['USUARIO']['username'];
}

function sendAjaxData($data, $statusCode = 200) {
	$data['status'] = $statusCode;
	echo json_encode($data);
}

function obtenerDatos($id_perfil) {
	$results = array();
	$res = doquery("SELECT * FROM {{table}} WHERE id = '{$id_perfil}' LIMIT 1", 'usuarios', false);
	while ($resultado = mysqli_fetch_assoc($res)) {
		$results['username'] = $resultado['username'];
		$results['telefono'] = $resultado['telefono'];
		$results['email'] = $resultado['email'];
		$results['productosInteresados'] = $resultado['productosInteresados'];
		$results['aceptaMensajes'] = $resultado['aceptaMensajes'];
		$results['imagenPerfil'] = $resultado['imagenPerfil'];
	}
	return $results;
}

function aceptaMensajes($id_perfil) {

	if (estoy_logeado()) {
		$datos = array();
		$datos = obtenerDatos(userId());
		$acpmsg = $datos['aceptaMensajes'];
	} else {
		$acpmsg = 0;
	}
	return $acpmsg;
}
?>
