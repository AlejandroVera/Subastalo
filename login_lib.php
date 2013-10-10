<?php
    /**
 * valida un usuario y contraseña
 * @param string $usuario
 * @param string $password
 * @return bool
 */
function login($email,$password) {
 
    //usuario y password tienen datos?
    if (empty($email)) return false;
    if (empty ($password)) return false;
 
    //query que devuelve password e id asociados a un username
    $res = doquery("SELECT email, username, password, id, nivel_acceso FROM {{table}} WHERE email = '{$email}' LIMIT 1",'usuarios',FALSE);
 
    //extraemos el registro de este usuario
    $row = mysqli_fetch_assoc($res);
 
    if ($row) {
        //Generamos el hash de la contraseña encriptada para comparar o lo dejamos como texto plano
    	$hash=sha1($password);
        //comprobamos la contraseña
        if ($email==$row['email'] and $hash==$row['password']) {
            $_SESSION['USUARIO']=array('username'=>$row['username'], 'id'=>$row['id'],
             'nivel_acceso'=>$row['nivel_acceso']); //almacenamos en memoria el usuario
            // en este punto puede ser interesante guardar más datos en memoria para su posterior uso, como por ejemplo un array asociativo con el id, nombre, email, preferencias, ....
            return true; //usuario y contraseña validadas
        } else {
          
            unset($_SESSION['USUARIO']); //destruimos la session activa al fallar el login por si existia
            return false; //no coincide la contraseña
        }
    } else {
        //El usuario no existe
        return false;
    }
}

/**
 * Veridica si el usuario está logeado
 * @return bool
 */
function estoy_logeado () {
     
    if (!isset($_SESSION['USUARIO'])) return 0; //no existe la variable $_SESSION['USUARIO']. No logeado.
    if (!is_array($_SESSION['USUARIO'])) return 0; //la variable no es un array $_SESSION['USUARIO']. No logeado.
    if (empty($_SESSION['USUARIO']['id'])) return 0; //no tiene almacenado el usuario en $_SESSION['USUARIO']. No logeado.
 
    //cumple las condiciones anteriores, entonces es un usuario validado
    return $_SESSION['USUARIO']['nivel_acceso'];
 
}

/**
 * Vacia la sesion con los datos del usuario validado
 */
function logout() {
    unset($_SESSION['USUARIO']); //eliminamos la variable con los datos de usuario;
    session_write_close(); //nos asegurmos que se guarda y cierra la sesion
    return true;
}
?>