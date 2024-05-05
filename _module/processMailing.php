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
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;               //Enable verbose debug output
        $mail->SMTPDebug = false;
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
        $mailing->status['codigo_status'] = 1;
		$mailing->status['descricao_status'] = 'E-mail enviado com sucesso';


    } catch (Exception $e) {
        $mailing->status['codigo_status'] = 2;
		$mailing->status['descricao_status'] = "Não foi possivel enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: {$mail->ErrorInfo}";
    }

}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
	<!-- Meta tags Obrigatórias -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Paulo Vitor Guedes">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>App Mail Send</title>

</head>

<body>

    <div class="container">
        <div class="py-3 text-center">
            <img class="d-block mx-auto mb-2" src="../_img/logo.png" alt="" width="72" height="72">
            <h2>Send Mail</h2>
            <p class="lead">Seu app de envio de e-mails particular!</p>
        </div>

        <div class="row">
            <div class="col-md-12">

                <?php if ($mailing->status['codigo_status'] == 1) { ?>

                    <div class="container">
                        <h1 class="display-4 text-success">Sucesso</h1>
                        <p><?= $mailing->status['descricao_status'] ?></p>
                        <a href="../index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
                    </div>

                <?php } ?>

                <?php if ($mailing->status['codigo_status'] == 2) { ?>

                    <div class="container">
                        <h1 class="display-4 text-danger">Ops!</h1>
                        <p><?= $mailing->status['descricao_status'] ?></p>
                        <a href="../index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>

</body>

</html>