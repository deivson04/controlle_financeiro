<?php

namespace Controller;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    session_unset();
}

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
       
        $_SESSION['usuario'] = [
        'idUsuario'   => $buscar['idUsuario'],
        'nome' => $buscar['nome'],
        'email'=> $buscar['email']
        ];

        header('Location: ../DashboardRota.php');
        exit;

        } else {
            
            echo 'Email ou senha invalidos';
        }
        
}
        echo '<br><br><a href="../View/loginView.php">Voltar ao login</a>';
        

