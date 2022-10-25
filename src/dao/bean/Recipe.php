<?php
    class Recipe{
        
        var $id;
        var $categoria;
        var $nome;
        var $descrizione;
        var $prezzo;
        var $stato;
        var $ingredienti;

        public function __construct($id, $categoria, $nome, $descrizione, $prezzo, $stato, $ingredienti){
            $this->id = $id;
            $this->categoria = $categoria;
            $this->nome = $nome;
            $this->descrizione = $descrizione;
            $this->prezzo = $prezzo;
            $this->stato = $stato;
            $this->ingredienti = $ingredienti;
        }

    }
?>