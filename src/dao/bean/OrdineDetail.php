<?php
    class OrdineDetail{
        
        var $id;
        var $idProdotto;
        var $quantita;
        var $idOrdine;
        var $prezzo;

        public function __construct($id, $idProdotto, $quantita, $idOrdine, $prezzo){
            $this->id = $id;
            $this->idProdotto = $idProdotto;
            $this->quantita = $quantita;
            $this->idOrdine = $idOrdine;
            $this->prezzo = $prezzo;
        }

    }
?>