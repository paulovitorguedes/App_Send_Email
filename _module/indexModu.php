<?php

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$subject = filter_input(INPUT_POST, 'subject', FILTER_DEFAULT);
$message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);

if($email && !empty($subject) && !empty($message)) {
    echo "mensagem válida";
} else {
    echo "Falhou";
}