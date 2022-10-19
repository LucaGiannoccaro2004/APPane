<?php
    class Session{
        
        var $id;
        var $cliente;
        var $token;
        var $timestamp;

        public function __construct($id, $cliente, $token, $timestamp){
            $this->id = $id;
            $this->cliente = $cliente;
            $this->token = $token;
            $this->timestamp = $timestamp;
        }

    }
?>