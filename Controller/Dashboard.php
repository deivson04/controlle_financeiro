<?php

namespace Controller;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    session_unset();
}

use Service\Fachada;
use Objeto\Usuario;

header('Content-Type: application/json');

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    
    $usuario = new Usuario();

    $usuario->setEmail($email);
    $usuario->setSenha($senha);


    // Instancia a Fachada e chama o método para inserir o usuário
    $fachada = new Fachada();

    $buscar = $fachada->buscarUsuarios($usuario);

    if ($buscar) {
        $_SESSION['logado'] = true;
       
        $_SESSION['usuario'] = [
        'idUsuario'   => $buscar['idUsuario'],
        'nome' => $buscar['nome'],
        'email'=> $buscar['email']
        ];

         // Retorna sucesso para o JS tratar o redirecionamento
        echo json_encode([
            'status' => 'success',
            'message' => 'Login realizado!',
            'redirect' => 'DashboardRota.php'
        ]);
        exit;
    } else {
        // Retorna erro se usuário/senha estiverem incorretos
        echo json_encode([
            'status' => 'error', 
            'message' => 'E-mail ou senha incorretos.'
        ]);
        exit;
    }
        
}