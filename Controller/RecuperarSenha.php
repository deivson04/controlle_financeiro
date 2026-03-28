<?php

namespace Controller;

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use Service\Fachada;
use Objeto\Usuario;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $usuario = new Usuario();

    $usuario->setEmail($_POST['email'] ?? '');

    // Instancia a Fachada e chama o método para inserir o usuário
    $fachada = new Fachada();

    $checkEmail = $fachada->buscarUsuarioPorEmail($usuario);

    if ($checkEmail === false) {

          echo json_encode([
            'status' => 'error', 
            'message' => 'E-mail não cadastrado.'
        ]);
        exit();

    } else {

        $_SESSION['idUsuario_recuperacao'] = $checkEmail['idUsuario'];
        
        echo json_encode([
        'status' => 'success',
        'message' => 'Usuário identificado! Redirecionando...',
        'redirect' => 'View/novaSenhaView.php'
        ]);
        exit();
    }
}
