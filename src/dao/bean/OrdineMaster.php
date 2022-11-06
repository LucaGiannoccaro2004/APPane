<?php
    class OrdineMaster{
        
        var $id;
        var $numero;
        var $idCliente;
        var $dataInserimento;
        var $nota;

        public function __construct($id, $numero, $idCliente, $dataInserimento, $nota){
            $this->id = $id;
            $this->numero = $numero;
            $this->idCliente = $idCliente;
            $this->dataInserimento = $dataInserimento;
            $this->nota = $nota;
        }

    }
?>