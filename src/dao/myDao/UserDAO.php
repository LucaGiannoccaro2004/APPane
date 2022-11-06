<?php

    require_once("dao/bean/User.php");

    class UserDAO{

        var $selectById = "SELECT * FROM tclienti WHERE id = ?;";
        var $selectByEmailAndPassword = "SELECT * FROM tclienti WHERE email = ? AND password = ? ;";
        var $insertUser = "INSERT INTO tclienti(email, password, indirizzo, note) VALUES(?, ?, ?, ?);";
        var $connection;

        public function __construct($connection){
            $this->connection = $connection;
        }

        public function selectById($id){
            $prepared = $this->connection->prepare($this->selectById);
            $prepared->bind_param("i", $id);
            $prepared->execute();
            $result = $prepared->get_result();
            $list = [];
            if ($user = $result->fetch_assoc())
                return new User($user['id'], $user['email'], $user['password'], $user['indirizzo'], $user['note']);
            return $list;
        }

        public function selectByEmailAndPassword($email, $password){
            $prepared = $this->connection->prepare($this->selectByEmailAndPassword);
            $prepared->bind_param("ss", $email, $password);
            $prepared->execute();
            $result = $prepared->get_result();
            $list = [];
            if ($user = $result->fetch_assoc())
                return new User($user['id'], $user['email'], $user['password'], $user['indirizzo'], $user['note']);
            return $list;
        }

        public function createUser($email, $password, $indirizzo, $note){
            $prepared = $this->connection->prepare($this->insertUser);
            $prepared->bind_param("ssss", $email, $password, $indirizzo, $note);
            return $prepared->execute();
        }
    
    }

?>