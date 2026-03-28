<?php

namespace Controller;

header('Content-Type: application/json; charset=utf-8');

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Service\Fachada;
use Objeto\Usuario;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $nome = trim($_POST['nome'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $senhaOriginal = $_POST['senhaCadastro'] ?? '';
  // validação lado do servido
  $erros = [];

  if (empty($nome)) {
    $erros['nome'] = "O campo Nome é obrigatório.";
  }
  if (empty($email)) {
    $erros['email'] = "O campo Email é obrigatório.";
  }
  if (empty($senhaOriginal)) {
    $erros['senha'] = "O campo Senha é obrigatório.";
  } elseif (strlen($senhaOriginal) < 6) {
    $erros['senha'] = "A senha deve ter no mínimo 6 caracteres.";
  }

  if (!empty($erros)) {
    echo json_encode([
            'status' => 'error',
            'message' => implode(" ", $erros)
        ]);
        exit();
    }


  $senhaCriptografada = password_hash($senhaOriginal, PASSWORD_BCRYPT);

  $usuario = new Usuario();
    
  $usuario->setNome($nome);
  $usuario->setEmail($email);
  $usuario->setSenha($senhaCriptografada);


  // Instancia a Fachada e chama o método para inserir o usuário
  $fachada = new Fachada();

  $checkEmail = $fachada->buscarUsuarioPorEmail($usuario);

  if ($checkEmail !== false) {
    // 1. O email já existe
    
    echo json_encode([
            'status' => 'error', 
            'message' => 'E-mail já cadastrado.'
        ]);
        exit;
        } else {
         
        // Faz a inserção no banco se o email não existir   
        $resultado = $fachada->inserirUsuario($usuario);
        
        if ($resultado) {
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Cadastro realizado com sucesso!',
            'redirect' => 'View/loginView.php'
        ]);
        exit;
        }
      }
}