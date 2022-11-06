<?php

    require_once("dao/bean/Cart.php");

    class CartDAO{

        var $selectByIdCliente = "SELECT tcarrello.id, tcarrello.idCliente, tcarrello.idProdotto, tcarrello.quantita, tcarrello.token, tprodotti.id AS idProdotto, tprodotti.nome, tprodotti.descrizione, tprodotti.prezzo, tprodotti.foto, tprodotti.abilitato, tcategorie.categoria
                                        FROM tcarrello
                                        JOIN tprodotti ON tcarrello.idProdotto = tprodotti.id
                                        JOIN tcategorie ON tprodotti.idCategoria = tcategorie.id
                                        WHERE tcarrello.idCliente = ?;";
        var $selectByToken = "SELECT tcarrello.id, tcarrello.idCliente, tcarrello.idProdotto, tcarrello.quantita, tcarrello.token, tprodotti.id AS idProdotto, tprodotti.nome, tprodotti.descrizione, tprodotti.prezzo, tprodotti.foto, tprodotti.abilitato, tcategorie.categoria
                                        FROM tcarrello
                                        JOIN tprodotti ON tcarrello.idProdotto = tprodotti.id
                                        JOIN tcategorie ON tprodotti.idCategoria = tcategorie.id
                                        WHERE tcarrello.token = ?;";

        var $udateIdCliente = "UPDATE `tcarrello` SET `idCliente`= ? WHERE token = ?";
        var $insert = "INSERT INTO tcarrello(idCliente, idProdotto, quantita, token) VALUES(?, ?, ?, ?);";
        var $connection;

        public function __construct($connection){
            $this->connection = $connection;
        }

        public function selectByToken($token){
            $prepared = $this->connection->prepare($this->selectByToken);
            $prepared->bind_param("s", $token);
            $prepared->execute();
            $result = $prepared->get_result();
            $list = [];
            if ($result->num_rows > 0)
                while($user = $result->fetch_assoc())
                    $list[] = new Cart($user['id'], $user['idCliente'], new Product($user['idProdotto'], $user['categoria'], $user['nome'], $user['descrizione'], $user['prezzo'], $user['abilitato'], $user['foto']), $user['quantita'], $user['token']);
            return $list;
        }

        public function selectByIdCliente($id){
            $prepared = $this->connection->prepare($this->selectByIdCliente);
            $prepared->bind_param("i", $id);
            $prepared->execute();
            $result = $prepared->get_result();
            $list = [];
            if ($result->num_rows > 0)
                while($user = $result->fetch_assoc())
                    $list[] =  new Cart($user['id'], $user['idCliente'], new Product($user['idProdotto'], $user['categoria'], $user['nome'], $user['descrizione'], $user['prezzo'], $user['abilitato'], $user['foto']), $user['quantita'], $user['token']);
            return $list;
        }

        public function udateIdCliente($idCliente, $token){
            $prepared = $this->connection->prepare($this->udateIdCliente);
            $prepared->bind_param("is", $idCliente, $token);
            return $prepared->execute();
        }

        public function insert($idCliente, $idProdotto, $quantita, $token){
            $prepared = $this->connection->prepare($this->insert);
            $prepared->bind_param("iiis", $idCliente, $idProdotto, $quantita, $token);
            return $prepared->execute();
        }
    
    }

?>