<?php
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

?>