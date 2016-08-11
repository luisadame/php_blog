<?php

    namespace App;

    use PDO;

    class Database {

        private $db_host = 'localhost';
        private $db_port = 3306;
        private $db_name = 'blog';
        private $db_user = 'root';
        private $db_password = 'root';
        static public $connection;

        public function __construct(){
           
            try {
                self::$connection = new PDO("mysql:host=$this->db_host;port=$this->db_port;dbname=$this->db_name", $this->db_user, $this->db_password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e){
                die('Error: ' . $e->getMessage());
            }
                
        }
        
    }