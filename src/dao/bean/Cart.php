<?php
    class Cart{
        
        var $id;
        var $idCliente;
        var $idProdotto;
        var $quantita;
        var $token;

        public function __construct($id, $idCliente, $idProdotto, $quantita, $token){
            $this->id = $id;
            $this->idCliente = $idCliente;
            $this->idProdotto = $idProdotto;
            $this->quantita = $quantita;
            $this->token = $token;
        }

    }
?>