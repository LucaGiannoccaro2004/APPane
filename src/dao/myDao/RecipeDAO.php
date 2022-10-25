<?php

    require_once("dao/bean/Recipe.php");

    class RecipeDAO{

        

        var $selectAll = "SELECT tricette.id, tricette.nome, tricette.descrizione, tricette.prezzo, tricette.stato, tcategorie.categoria 
                            FROM tricette
                            JOIN tcategorie ON tricette.idCategoria = tcategorie.id;";
        var $selectById = "SELECT tricette.id, tricette.nome, tricette.descrizione, tricette.prezzo, tricette.stato, tcategorie.categoria 
                            FROM tricette
                            JOIN tcategorie ON tricette.idCategoria = tcategorie.id
                            WHERE tricette.id = ?;";
        var $getRicipesIngredients =   "SELECT tingredienti.id, tingredienti.nome, tingredienti.descrizione 
                                        FROM `tricette` 
                                        JOIN tricette_x_tingredienti ON tricette.id = tricette_x_tingredienti.idRicetta
                                        JOIN tingredienti ON tricette_x_tingredienti.idIngrediente = tingredienti.id
                                        WHERE tricette.id = ?;";
        var $insert = "INSERT INTO tricette(nome, descrizione, prezzo, stato) VALUES (?, ?, ?, ?)";
        var $updateById = "UPDATE tricette SET nome=?, descrizione=?, prezzo=?, stato=? WHERE id=?";
        var $deleteById = "DELETE FROM tricette WHERE id=?";
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
                    $prepared = $this->connection->prepare($this->getRicipesIngredients);
                    $prepared->bind_param("i", $row['id']);
                    $prepared->execute();
                    $ingredientResult = $prepared->get_result();
                    $ingredients = [];
                    if ($ingredientResult->num_rows > 0)
                        while($ingredient = $ingredientResult->fetch_assoc())
                            $ingredients[] = new Ingredient($ingredient['id'], $ingredient['nome'], $ingredient['descrizione']);
                    $list[] = new Recipe($row['id'], $row['categoria'], $row['nome'], $row['descrizione'], $row['prezzo'], $row['stato'], $ingredients);
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
                    $prepared = $this->connection->prepare($this->getRicipesIngredients);
                    $prepared->bind_param("i", $row['id']);
                    $prepared->execute();
                    $ingredientResult = $prepared->get_result();
                    $ingredients = [];
                    if ($ingredientResult->num_rows > 0)
                        while($ingredient = $ingredientResult->fetch_assoc())
                            $ingredients[] = new Ingredient($ingredient['id'], $ingredient['nome'], $ingredient['descrizione']);
                    $list[] = new Recipe($row['id'], $row['categoria'], $row['nome'], $row['descrizione'], $row['prezzo'], $row['stato'], $ingredients);
                }
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