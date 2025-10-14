<?php

namespace Controller;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use Service\Fachada;

// Verifica se o Google enviou o código de retorno
if (isset($_GET['code'])) {

    $fachada = new Fachada();

    // 1. Obtém o array com o nome, email, etc.
    $dadosUsuario = $fachada->googleCallback($_GET['code']);
    //var_dump($dadosUsuario);
    //die();
    if ($dadosUsuario && isset($dadosUsuario['nome'])) {

        // 2. 🔑 SALVA APENAS O NOME NA SESSÃO
        $_SESSION['logado'] = true;
        $_SESSION["nome"] = $dadosUsuario['nome']; // Usa o nome diretamente

        // 3. Redireciona para limpar o '?code' da URL
        header('Location: ../View/DashboardView.php');
        exit();
    } else {
        echo "Erro ao autenticar com o Google.";
    }
}

echo '<br><br><a href="../View/loginView.php">Voltar ao login</a>';
