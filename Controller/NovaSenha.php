<?php

namespace Controller;

require_once __DIR__ . '/../vendor/autoload.php';

use Service\Fachada;
use Objeto\Usuario;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = new Usuario();

    $usuario->setSenha($_POST['novaSenha'] ?? '');
    $usuario->setIdUsuario($_POST['idUsuario'] ?? '');

    // Instancia a Fachada e chama o método para inserir o usuário
    $fachada = new Fachada();

    $atualizarSenha = $fachada->atualizarSenha($usuario);

    if ($atualizarSenha) {
        echo 'Senha atualizada com sucesso<br>';
        echo '<br><br><a href="../View/loginView.php">Voltar ao login</a>';
    } else {
        echo 'Erro: A senha não pôde ser atualizada.';
    }
}
