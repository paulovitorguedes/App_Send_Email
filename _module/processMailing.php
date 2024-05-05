<?php

require '../_lib/_PHPMailer/Exception.php';
require '../_lib/_PHPMailer/PHPMailer.php';
require '../_lib/_PHPMailer/SMTP.php';

require_once "../_class/email.php";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
//require 'vendor/autoload.php';


$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$subject = filter_input(INPUT_POST, 'subject', FILTER_DEFAULT);
$message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);



if ($email && !empty($subject) && !empty($message)) {
    $mailing = new Email($email, $subject, $message);
    
    // echo $mailing->__get('$email');
    send($mailing);
} else {
    echo "Falhou";
}


function send($mailing)
{



    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;               //Enable verbose debug output
        $mail->isSMTP();                                     //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                      //Set the SMTP server to send through
        $mail->SMTPAuth = true;                              //Enable SMTP authentication
        $mail->Username = 'phpmailer.pvtestes@gmail.com';    //SMTP username
        $mail->Password = 'zqcp iwfz gqxh rfal';             //SMTP password (necessário criar senha de app no gmail)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;     //Enable implicit TLS encryption
        $mail->Port = 465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('phpmailer.pvtestes@gmail.com', 'APP SEND EMAIL');
        $mail->addAddress($mailing->__get('$email'), 'phpmailing');     //Add a recipient
        //$mail->addAddress('phpmailer.pvtestes@gmail.com', 'phpmailer');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        //$mail->Subject = 'Here is the subject';
        //$mail->Body = 'This is the HTML message body <strong>in bold!</strong>';
        $mail->Subject = $mailing->__get('$subject');
        $mail->Body = $mailing->__get('$message');
        $mail->AltBody = 'É necessário utilizar um client que suporte HTML';

        $mail->send();
        echo 'E-mail Enviada com sucesso';


    } catch (Exception $e) {
        echo "Não foi possivel enviar esse email. Mailer Error: {$mail->ErrorInfo}";
    }

}