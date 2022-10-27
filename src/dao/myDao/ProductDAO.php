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
                            WHERE tprodotti.abilitato = 1;";
        var $getRicipesIngredients =   "SELECT tingredienti.id, tingredienti.nome, tingredienti.descrizione 
                                        FROM tprodotti
                                        JOIN tricette_x_tingredienti ON tprodotti.id = tricette_x_tingredienti.idRicetta
                                        JOIN tingredienti ON tricette_x_tingredienti.idIngrediente = tingredienti.id
                                        WHERE tprodotti.id = ?;";
        // var $insert = "INSERT INTO tprodotti(nome, descrizione, prezzo, abilitato) VALUES (?, ?, ?, ?)";
        // var $updateById = "UPDATE tprodotti SET nome=?, descrizione=?, prezzo=?, abilitato=? WHERE id=?";
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
                    $prepared = $this->connection->prepare($this->getRicipesIngredients);
                    $prepared->bind_param("i", $row['id']);
                    $prepared->execute();
                    $ingredientResult = $prepared->get_result();
                    $ingredients = [];
                    if ($ingredientResult->num_rows > 0)
                        while($ingredient = $ingredientResult->fetch_assoc())
                            $ingredients[] = new Ingredient($ingredient['id'], $ingredient['nome'], $ingredient['descrizione']);
                    $list[] = new Product($row['id'], $row['categoria'], $row['nome'], $row['descrizione'], $row['prezzo'], $row['abilitato'], $ingredients, $row['foto']);
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
                    $list = new Product($row['id'], $row['categoria'], $row['nome'], $row['descrizione'], $row['prezzo'], $row['abilitato'], $ingredients, $row['foto']);
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
                    $prepared = $this->connection->prepare($this->getRicipesIngredients);
                    $prepared->bind_param("i", $row['id']);
                    $prepared->execute();
                    $ingredientResult = $prepared->get_result();
                    $ingredients = [];
                    if ($ingredientResult->num_rows > 0)
                        while($ingredient = $ingredientResult->fetch_assoc())
                            $ingredients[] = new Ingredient($ingredient['id'], $ingredient['nome'], $ingredient['descrizione']);
                    $list = new Product($row['id'], $row['categoria'], $row['nome'], $row['descrizione'], $row['prezzo'], $row['abilitato'], $ingredients, $row['foto']);
                }
            return $list;
        }

        public function insert($categoria){
            // $prepared = $this->connection->prepare($this->insert);
            // $prepared->bind_param("s", $categoria);
            // return $prepared->execute();
        }

        public function updateById($categoria, $id){
            // $prepared = $this->connection->prepare($this->updateById);
            // $prepared->bind_param("si", $categoria, $id);
            // return $prepared->execute();
        }

        public function deleteById($id){
            $prepared = $this->connection->prepare($this->deleteById);
            $prepared->bind_param("i", $id);
            return $prepared->execute();
        }
    
    }

?>