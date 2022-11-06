<?php

    require_once("dao/bean/Product.php");

    class ProductDAO{

        

        var $selectAll = "SELECT tprodotti.id, tprodotti.nome, tprodotti.descrizione, tprodotti.prezzo, tprodotti.abilitato, tcategorie.categoria, tprodotti.foto 
                            FROM tprodotti
                            JOIN tcategorie ON tprodotti.idCategoria = tcategorie.id;";
        var $selectById = "SELECT tprodotti.id, tprodotti.nome, tprodotti.descrizione, tprodotti.prezzo, tprodotti.abilitato, tcategorie.categoria, tprodotti.foto 
                            FROM tprodotti
                            JOIN tcategorie ON tprodotti.idCategoria = tcategorie.id
                            WHERE tprodotti.id = ?;";
        var $selectPublished = "SELECT tprodotti.id, tprodotti.nome, tprodotti.descrizione, tprodotti.prezzo, tprodotti.abilitato, tcategorie.categoria, tprodotti.foto 
                            FROM tprodotti
                            JOIN tcategorie ON tprodotti.idCategoria = tcategorie.id
                            WHERE tprodotti.abilitato = 's';";
        var $selectPublishedByCat = "SELECT tprodotti.id, tprodotti.nome, tprodotti.descrizione, tprodotti.prezzo, tprodotti.abilitato, tcategorie.id AS idCategoria, tcategorie.categoria, tprodotti.foto 
                            FROM tprodotti
                            JOIN tcategorie ON tprodotti.idCategoria = tcategorie.id
                            WHERE tprodotti.abilitato = 's' AND tcategorie.id = ?;";

        var $deleteById = "DELETE FROM tprodotti WHERE id=?";
        var $connection;

        public function __construct($connection){
            $this->connection = $connection;
        }

        public function selectAll(){
            $prepared = $this->connection->prepare($this->selectAll);
            $prepared->execute();
            $result = $prepared->get_result();
            $list = [];
            if ($result->num_rows > 0)
                while($row = $result->fetch_assoc()){
                    $list[] = new Product($row['id'], $row['categoria'], $row['nome'], $row['descrizione'], $row['prezzo'], $row['abilitato'], $row['foto']);
                }
            return $list;
        }

        public function selectById($id){
            $prepared = $this->connection->prepare($this->selectById);
            $prepared->bind_param("i", $id);
            $prepared->execute();
            $result = $prepared->get_result();
            $list = [];
            if ($result->num_rows > 0)
                while($row = $result->fetch_assoc()){
                    $list[] = new Product($row['id'], $row['categoria'], $row['nome'], $row['descrizione'], $row['prezzo'], $row['abilitato'], $row['foto']);
                }
            return $list;
        }

        public function selectPublished(){
            $prepared = $this->connection->prepare($this->selectPublished);
            $prepared->execute();
            $result = $prepared->get_result();
            $list = [];
            if ($result->num_rows > 0)
                while($row = $result->fetch_assoc()){
                    $list[] = new Product($row['id'], $row['categoria'], $row['nome'], $row['descrizione'], $row['prezzo'], $row['abilitato'], $row['foto']);
                }
            return $list;
        }

        public function selectPublishedByCat($idCategoria){
            $prepared = $this->connection->prepare($this->selectPublishedByCat);
            $prepared->bind_param("i", $idCategoria);
            $prepared->execute();
            $result = $prepared->get_result();
            $list = [];
            if ($result->num_rows > 0)
                while($row = $result->fetch_assoc()){
                    $list[] = new Product($row['id'], new Categorie($row['idCategoria'], $row['categoria']), $row['nome'], $row['descrizione'], $row['prezzo'], $row['abilitato'], $row['foto']);
                }
            return $list;
        }
    
    }

?>