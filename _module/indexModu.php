<?php

require_once "../_class/email.php";



$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$subject = filter_input(INPUT_POST, 'subject', FILTER_DEFAULT);
$message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);



if($email && !empty($subject) && !empty($message)) {
    $mailing = new Email($email, $subject, $message);
    echo var_dump($mailing);
} else {
    echo "Falhou";
}