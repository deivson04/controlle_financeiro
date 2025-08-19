<?php

namespace Config;

use PDO;
use PDOException;


class Conexao {

    private $servername = "localhost";
    private $username = "root";
    private $password = "123456";
    private $database = "controle_financeiro";




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