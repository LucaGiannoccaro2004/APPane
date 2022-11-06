<?php
	class Database{

        var $hostname = "localhost";
        var $username = "root";
        var $password = "";
        var $database = "appane";

        private static $instance;
        private $connection;

        private function __construct(){
            $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database); 
        }

        public function getConnection(){
            return $this->connection;
        }

        public static function getInstance(){
            return is_null(self::$instance) ? new Database() : self::$instance;
        }

	}
?>