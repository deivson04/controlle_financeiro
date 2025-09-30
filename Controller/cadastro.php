<?php

namespace Controller;

require_once '../Service/fachada.php';
require_once '../Objeto/usuario.php';

use Service\Fachada;
use Objeto\Usuarios;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $usuario = new Usuarios();

    $usuario->setNome($_POST['nome'] ?? '');
    $usuario->setEmail($_POST['email'] ?? '');
    $usuario->setSenha($_POST['senha'] ?? '');

     // Instancia a Fachada e chama o método para inserir o usuário
    $fachada = new Fachada();
    
    $checkEmail = $fachada->buscarUsuarios($usuario);

if ($checkEmail > 0) {
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