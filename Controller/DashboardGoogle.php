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
    
    if ($dadosUsuario && isset($dadosUsuario['nome']) && isset($dadosUsuario['id_google']) && isset($dadosUsuario['email'])) {


        $_SESSION['logado'] = true;
        
        // array de dados.
        $_SESSION['usuario'] = [
        
      'nome' =>  $dadosUsuario['nome'],
        'id' => $dadosUsuario['id_google'],
       'email' => $dadosUsuario['email']
        ];
        
        header('Location: ../DashboardRota.php');
        exit;

}

