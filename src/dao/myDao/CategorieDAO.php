<?php

    require_once("dao/bean/Categorie.php");

    class CategorieDAO{

        var $selectAll = "SELECT * FROM tcategorie;";
        var $updateById = "UPDATE tcategorie SET categoria=? WHERE id=?";
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

        public function updateById($categoria, $id){
            $prepared = $this->connection->prepare($this->updateById);
            $prepared->bind_param("si", $categoria, $id);
            return $prepared->execute();
        }
    
    }

?>