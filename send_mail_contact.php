<?php
 
/* ENVIAR EMAILS */ 		 
 function enviarEmail($asunto, $para, $para_name, $desde, $desde_email, $body, $cc = null, $cc_name = null)
    { 

        require_once(__DIR__ . '/mailer/class.phpmailer.php');
        require_once(__DIR__ . '/mailer/class.smtp.php');

        $mail = new PHPMailer(true);
        
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;
        //Set the hostname of the mail server
        $mail->Host = 'c1370926.ferozo.com';
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 587;

        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $mail->Username = 'sender@barrancassuites.com';
        //Password to use for SMTP authentication
        $mail->Password = 'b5Nd/*w0bI';

        //Set who the message is to be sent from
        $mail->setFrom($desde_email, utf8_decode($desde));
        //Set an alternative reply-to address
        $mail->addReplyTo($desde_email, utf8_decode($desde));
        //Set who the message is to be sent to
        $mail->addAddress($para, $para_name);

        if(!empty($cc)){
        	 $mail->addCC($cc, $cc_name);
        }

        //Set the subject line
        $mail->Subject = $asunto;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($body);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        //send the message, check for errors

        $send = $mail->send();
   
        if (!$send) {
            return 'error_envio: ' . $mail->ErrorInfo; 
        }

        return 'ok';


    }
 
$to = 'info@barrancassuites.com';
$from = $_POST['email'];
$name = $_POST['nombre'];
$subject = $_POST['asunto'];
$msg = $_POST['mensaje'];
 
$envio = enviarEmail($subject, $to, $to, $name, $from, $msg);


 
if($envio == 'ok'){
    echo '<p class="reservation-confirm">Gracias por comunicarse. Responderemos a la brevedad.</p>';
}else{
    echo '<h2>El envío falló. '.$envio.'</h2>';
}
?>


