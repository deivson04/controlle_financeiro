<?php

namespace Controller;

session_start();


require_once "../Service/fachada.php";
require_once "../Objeto/usuario.php";


use Service\Fachada;
use Objeto\Usuarios;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $usuario = new Usuarios();

    $usuario->setEmail($_POST['email'] ?? '');
  

    // Instancia a Fachada e chama o método para inserir o usuário
    $fachada = new Fachada();
    
    $buscar = $fachada->buscarUsuarios($usuario);
    
    if ($buscar) {
        $_SESSION["idUsuario"] = $buscar["idUsuario"];
        $_SESSION["nome"] = $buscar["nome"];
        
        header('Location: ../View/dashboardView.php');
        exit();
    } else {

        echo "Email e senha incorretos";
        
    }

   

    echo '<br><br><a href="../View/loginView.php">Voltar ao login</a>';


}

