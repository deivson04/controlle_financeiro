<?php

namespace Config;

use PDO;
use PDOException;

class Conexao {

private $servername = "127.0.0.1";
private $username = "root";
private $password = "root";
private $database = "db_finance";

public function conectar() {

try {
    $conn = new PDO("mysql:host=$this->servername;dbname=$this->database;charset=utf8mb4", $this->username, $this->password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
    }
  }
}
