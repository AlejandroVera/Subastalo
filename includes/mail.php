<?php

// Pear Mail Library
require_once(IS2_ROOT_PATH . "libs/Mail/Mail.php");

function sendMail($to, $subject, $body){
        
    //Cargamos la configuracion del servidor de correo
    require(IS2_ROOT_PATH . "includes/config/mailConfig.php");
    
    $from = "<{$mailConfig['email']}>";
    $to = "<{$to}>";
    
    $headers = array(
        'From' => $from,
        'To' => $to,
        'Subject' => $subject
    );
    
    
    
    $smtp = Mail::factory('smtp', $mailConfig);
    
    $mail = $smtp->send($to, $headers, $body);
    
    if (PEAR::isError($mail)) {
        return false;
        //echo('<p>' . $mail->getMessage() . '</p>');
    } else {
        return true;
    }
}

?>