<?php
//Contraseña debe tener al menos un número y un carácter especial y no tener menos de 6 caracteres
function isValidPass($pass){
    return strlen($pass) >= 6 && preg_match("#[0-9]+#", $pass) && preg_match("#\W+#", $pass);
}

function isValidEmail($email){
    return !!filter_var($email, FILTER_VALIDATE_EMAIL); 
}

?>