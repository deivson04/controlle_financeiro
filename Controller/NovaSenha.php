<?php

namespace Controller;

header('Content-Type: application/json; charset=utf-8');


require_once __DIR__ . '/../vendor/autoload.php';

use Service\Fachada;
use Objeto\Usuario;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $senhaOriginal = $_POST['novaSenha'] ?? '';
    $idUsuario = $_POST['idUsuario'] ?? '';

    $erros = [];

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

    $usuario->setSenha($senhaCriptografada);
    $usuario->setIdUsuario($idUsuario);

    // Instancia a Fachada e chama o método para inserir o usuário
    $fachada = new Fachada();

    $atualizarSenha = $fachada->atualizarSenha($usuario);

    if ($atualizarSenha) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Senha atualizada com sucesso!',
            'redirect' => './View/loginView.php'
        ]);
        exit;
    
    } else {
        echo json_encode([
            'status' => 'error', 
            'message' => 'Senha não atualizada.'
        ]);
        exit;
    }
}
