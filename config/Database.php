<?php
    class Database {
        // DB Params
        private $host = 'wcwimj6zu5aaddlj.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        private $db_name = 'kry1wfmipjfizjf1';
        private $username = 'xru9lrkejslzd190';
        private $password = 'uj2dxkdj2syk9p2o';
        private $conn;

        // DB Connection
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name , $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }