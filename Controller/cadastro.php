<?php

namespace Controller;

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Service\Fachada;
use Objeto\Usuario;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senhaOriginal = $_POST['senhaCadastro'] ?? '';

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
        echo 'Erros encontrados:<br>';
        foreach ($erros as $mensagem) {
            echo "- $mensagem<br>";
        }
        echo '<br><br><a href="../View/cadastroView.php">Voltar ao cadastro</a>';
        exit();
    }

    $senhaCriptografada = password_hash($senhaOriginal, PASSWORD_BCRYPT);

    $usuario = new Usuario();

    $usuario->setNome($_POST['nome'] ?? '');
    $usuario->setEmail($_POST['email'] ?? '');
    $usuario->setSenha($senhaCriptografada);


    // Instancia a Fachada e chama o método para inserir o usuário
    $fachada = new Fachada();

    $checkEmail = $fachada->buscarUsuarios($usuario);

    if ($checkEmail !== false) {
        // 1. O email já existe
        echo 'Email já cadastrado!';
    } else {
        // 2. O email está livre, tenta cadastrar
        $sucesso = $fachada->inserirUsuario($usuario);

        if ($sucesso) {
            echo 'Usuário cadastrado com sucesso';
        } else {
            echo 'Erro: Usuário não pôde ser cadastrado.';
        }
    }
    echo '<br>';
    echo '<a href="../index.php">Voltar</a>';
}
