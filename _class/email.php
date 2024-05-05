<?php

class Email{

    private $email = "";
    private $subject = "";
    private $message = "";
    public $status = array( 'codigo_status' => null, 'descricao_status' => '' );

    function __construct($email, $subject, $message){
        $this->__set('$email', $email);
        $this->__set('$subject', $subject);
        $this->__set('$message', $message);
        
    }

    public function __get($attr){
        return $this->$attr;
    }
    public function __set($attr, $value){
        $this->$attr = $value;
    }

}