<?php

    require_once("dao/bean/OrdineDetail.php");
    require_once("dao/bean/OrdineMaster.php");

    class OrdineDAO{

        var $getLastId = "SELECT id FROM tordinimaster WHERE idCliente = ? ORDER BY datains DESC";
        var $insertMaster = "INSERT INTO `tordinimaster`(`numero`, `idCliente`, `datains`, `nota`) VALUES (?, ?, ?, ?)";
        var $insertDetail = "INSERT INTO `tordinidetail`(`idProdotto`, `quantita`, `idOrdine`, `prezzo`) VALUES (?, ?, ?, ?)";
        var $connection;

        public function __construct($connection){
            $this->connection = $connection;
        }

        public function getLastId($idCLiente){
            $prepared = $this->connection->prepare($this->getLastId);
            $prepared->bind_param("i", $idCLiente);
            $prepared->execute();
            $result = $prepared->get_result();
            $list;
            if ($row = $result->fetch_assoc())
                    return $row['id'];
        }

        public function insertMaster($numero, $idCliente, $datains, $nota){
            $prepared = $this->connection->prepare($this->insertMaster);
            $prepared->bind_param("iiss", $numero, $idCliente, $datains, $nota);
            return $prepared->execute();
        }

        public function insertDetail($idProdotto, $quantita, $idOrdine, $prezzo){
            $prepared = $this->connection->prepare($this->insertDetail);
            $prepared->bind_param("iiid", $idProdotto, $quantita, $idOrdine, $prezzo);
            return $prepared->execute();
        }
    
    }

?>