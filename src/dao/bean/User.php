<?php
    class User{
        
        var $id;
        var $email;
        var $password;
        var $indirizzo;
        var $note;

        public function __construct($id, $email, $password, $indirizzo, $note){
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;
            $this->indirizzo = $indirizzo;
            $this->note = $note;
        }

    }
?>