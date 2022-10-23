<?php

    require_once("dao/bean/Ingredient.php");

    class IngredientDAO{

        var $selectAll = "SELECT * FROM tingredienti;";
        var $insert = "INSERT INTO tingredienti(nome, descrizione) VALUES (?, ?)";
        var $updateById = "UPDATE tingredienti SET nome=?, descrizione=? WHERE id=?";
        var $deleteById = "DELETE FROM tingredienti WHERE id=?";
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
                    $list[] = new Ingredient($row['id'], $row['nome'], $row['descrizione']);
            return $list;
        }

        public function insert($nome, $descrizione){
            $prepared = $this->connection->prepare($this->insert);
            $prepared->bind_param("ss", $nome, $descrizione);
            return $prepared->execute();
        }

        public function updateById($nome, $descrizione, $id){
            $prepared = $this->connection->prepare($this->updateById);
            $prepared->bind_param("ssi", $nome, $descrizione, $id);
            return $prepared->execute();
        }

        public function deleteById($id){
            $prepared = $this->connection->prepare($this->deleteById);
            $prepared->bind_param("i", $id);
            return $prepared->execute();
        }
    
    }

?>