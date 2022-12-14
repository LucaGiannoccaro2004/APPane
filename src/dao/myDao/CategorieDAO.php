<?php

    require_once("dao/bean/Categorie.php");

    class CategorieDAO{

        var $selectAll = "SELECT * FROM tcategorie;";
        var $insert = "INSERT INTO tcategorie(categoria) VALUES (?)";
        var $updateById = "UPDATE tcategorie SET categoria=? WHERE id=?";
        var $deleteById = "DELETE FROM tcategorie WHERE id=?";
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
                while($row = $result->fetch_assoc())
                    $list[] = new Categorie($row['id'], $row['categoria']);
            return $list;
        }

        public function insert($categoria){
            $prepared = $this->connection->prepare($this->insert);
            $prepared->bind_param("s", $categoria);
            return $prepared->execute();
        }

        public function updateById($categoria, $id){
            $prepared = $this->connection->prepare($this->updateById);
            $prepared->bind_param("si", $categoria, $id);
            return $prepared->execute();
        }

        public function deleteById($id){
            $prepared = $this->connection->prepare($this->deleteById);
            $prepared->bind_param("i", $id);
            return $prepared->execute();
        }
    
    }

?>