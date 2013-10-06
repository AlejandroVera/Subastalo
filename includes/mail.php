<?php

// Pear Mail Library
require_once(IS2_ROOT_PATH . "libs/Mail/Mail.php");
//require_once(IS2_ROOT_PATH . "libs/Mail_Mime/Mail/mime.php");
require_once(IS2_ROOT_PATH . "libs/Mail/Mail/mime.php");
//require_once(IS2_ROOT_PATH . "libs/Mail/Mail/mimePart.php");

function sendMail($to, $subject, $body){
        
    //Cargamos la configuracion del servidor de correo
    require(IS2_ROOT_PATH . "includes/config/mailConfig.php");
    
    $from = "<{$mailConfig['email']}>";
    $to = "<{$to}>";
    $crlf = "\n";
    
    $headers = array(
        'From' => $from,
        'To' => $to,
        'Subject' => $subject
    );
    
    $html = "<html><head><title>$subject</title></head><body>".$body."</body></html>";
    
    // Creating the Mime message
    $mime = new Mail_mime($crlf);

    // Setting the body of the email
    //$mime->setTXTBody($text);
    $mime->setHTMLBody($html);
    $mimeparams['html_charset']="UTF-8";
    $mimeparams['head_charset']="UTF-8";  

    $body = $mime->get($mimeparams);
    $headers = $mime->headers($headers);

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