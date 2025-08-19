<?php

namespace Model;

require_once '../Config/conexao.php';

use PDO;
use Config\Conexao;

class UsuariosRepository {

    protected $con;

    public function __construct() {
        
        $conexao = new Conexao();
        
        $this->con = $conexao->conectar();
        
        // if ($this->con === null || $this->con === false) {
        // die("Erro: Não foi possível conectar ao banco de dados. Verifique a classe Conexao.");
     // }
    
    }

    public function inserirUsuario($usuario) {
         
        
            $nome = $usuario->getNome();
            $email = $usuario->getEmail();
            $senha = $usuario->getSenha();

            $sql = "INSERT INTO usuarios (nome, email, senha) 
            VALUES (:nome, :email, :senha)";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);

            $stmt->execute();
            
            return $stmt; 
    }

    public function buscarUsuarios($usuario) {
        
        $email = $usuario->getEmail();
        

        $sql = "SELECT idUsuario, nome, email
                FROM usuarios
                WHERE email = :email";
        
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(":email", $email);
        

        $stmt->execute(); 
    
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
}