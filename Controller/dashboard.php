<?php

namespace Controller;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use Service\Fachada;
use Objeto\Usuario;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $usuario = new Usuario();

    $usuario->setEmail($_POST['email'] ?? '');
    $usuario->setSenha($_POST['senha'] ?? '');


    // Instancia a Fachada e chama o método para inserir o usuário
    $fachada = new Fachada();

    $buscar = $fachada->buscarUsuarios($usuario);

    if ($buscar) {
        $_SESSION['logado'] = true;
        $_SESSION["idUsuario"] = $buscar["idUsuario"];
        $_SESSION["nome"] = $buscar["nome"];

        header('Location: ../View/DashboardView.php');
        exit();
    } else {

        echo "Email e senha incorretos";
    }

    echo '<br><br><a href="../View/loginView.php">Voltar ao login</a>';
}
