<?php
    class Product{
        
        var $id;
        var $categoria;
        var $nome;
        var $descrizione;
        var $prezzo;
        var $stato;
        var $foto;

        public function __construct($id, $categoria, $nome, $descrizione, $prezzo, $stato, $foto){
            $this->id = $id;
            $this->categoria = $categoria;
            $this->nome = $nome;
            $this->descrizione = $descrizione;
            $this->prezzo = $prezzo;
            $this->stato = $stato;
            $this->foto = $foto;
        }

    }
?>