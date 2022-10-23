<?php
    class Ingredient{
        
        var $id;
        var $nome;
        var $descrizione;

        public function __construct($id, $nome, $descrizione){
            $this->id = $id;
            $this->nome = $nome;
            $this->descrizione = $descrizione;
        }

    }
?>