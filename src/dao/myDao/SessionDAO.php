<?php

    require_once("dao/bean/Session.php");

    class SessionDAO{

        var $selectByToken = "SELECT * FROM tsessioni WHERE token = ?;";
        var $insertSession = "INSERT INTO tsessioni(clienteId, token) VALUES(?, ?);";
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
            if ($session = $result->fetch_assoc()){
                $userDAO  = new UserDAO(Database::getInstance()->getConnection());
			    $user = $userDAO->selectById($session['clienteId']);
                return new Session($session['id'], $user, $session['token'], $session['timestamp']);
            }
            return $list;
        }

        public function createSession($clienteId, $token){
            $prepared = $this->connection->prepare($this->insertSession);
            $prepared->bind_param("ss", $clienteId, $token);
            return $prepared->execute();
        }
    
    }

?>