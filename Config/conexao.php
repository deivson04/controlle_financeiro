<?php

namespace Config;

use PDO;
use PDOException;


class Conexao {

    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "root";
    private $database = "db_finance";
<<<<<<< Updated upstream
=======


>>>>>>> Stashed changes


    public function conectar(){

        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->database;charset=utf8mb4", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "connected successfully";
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}