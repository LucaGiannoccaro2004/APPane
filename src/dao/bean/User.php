<?php
    class User{
        
        var $id;
        var $email;
        var $password;
        var $indirizzo;
        var $note;
        var $tipo;

        public function __construct($id, $email, $password, $indirizzo, $note, $tipo){
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;
            $this->indirizzo = $indirizzo;
            $this->note = $note;
            $this->tipo = $tipo;
        }

    }
?>