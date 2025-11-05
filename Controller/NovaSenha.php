<?php

namespace Controller;

require_once __DIR__ . '/../vendor/autoload.php';

use Service\Fachada;
use Objeto\Usuario;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $senhaOriginal = $_POST['novaSenha'] ?? '';

    $erros = [];

    if (empty($senhaOriginal)) {
        $erros['senha'] = "O campo Senha é obrigatório.";
    } elseif (strlen($senhaOriginal) < 6) {
        $erros['senha'] = "A senha deve ter no mínimo 6 caracteres.";
    }

    if (!empty($erros)) {
        echo 'Erros encontrados:<br>';
        foreach ($erros as $mensagem) {
            echo "- $mensagem<br>";
        }
        echo '<br><br><a href="../View/novaSenhaView.php">Voltar para alterar a senha</a>';
        exit();
    }

    $senhaCriptografada = password_hash($senhaOriginal, PASSWORD_BCRYPT);

    $usuario = new Usuario();

    $usuario->setSenha($senhaCriptografada);
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
