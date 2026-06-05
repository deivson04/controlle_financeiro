<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use Service\Fachada;

$fachada = new Fachada();

$authUrl = $fachada->googleAuthLogin();


?>


<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Controller Login</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">

</head>

<body data-page="login">

  <div class="page">

    <div class="page-card shadow-lg">

      <div id="mensagem" class="mb-3 text-center"></div>

      <form id="form" method="POST" class="custom-width">

        <h1 class="text-center mb-4">Controlle Login</h1>

        <div class="form-group mb-3">

          <label class="mb-2">Email</label>

          <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" data-required="true">

        </div>


        <div class="form-group mb-3">

          <label class="mb-2">Senha</label>
         
          <div class="position-relative">
          <input type="password" class="form-control bi bi-eye-slash" id="senha" name="senha" placeholder="Digite sua senha" data-required="true">
          
          <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="toggleIcon" style="cursor: pointer; z-index: 10;"></i></div>

        </div><br>


        <button type="submit" class="btn btn-primary  w-100 btn-success" id="btnEnviar">Entrar</button><br><br>

        <div class="text-center mt-3 mb-3">
          <hr>
          <p>ou</p>
        </div>
        <div class="text-center mt-3 mb-3">
          <a href="<?= $authUrl ?>"
            type="button"
            class="btn btn-outline-secondary btn-google w-100 d-flex align-items-center justify-content-center">
            Acessar com o Google
          </a>
        </div>
        <p class="form-text mt-3 link">Ainda não tem uma conta? <a href="cadastroView.php">Cadastre-se aqui</a></p>
        <p class="form-text mt-3 link">Esqueceu sua senha? <a href="recuperarSenhaView.php">Clique aqui</a></p>
        <p class="form-text mt-3 link">Deseja voltar ao inicio? <a href="../index.php">Clique aqui</a></p>
    </div>
  </div>


  <script src="js/bootstrap.min.js"></script>
  <script>
    // Detecta o caminho atual na barra de endereços
    const currentPath = window.location.pathname;

    // Se a URL contém a pasta do Windows, define a base longa. 
    // Caso contrário (Android/Infinity), fica vazio para usar a raiz.
    const BASE_URL = currentPath.includes('git_controlle_financeiro') ?
      '/git_controlle_financeiro/controlle_financeiro' :
      '';

    console.log("Caminho Base do Projeto:", BASE_URL || "Raiz (/)");
  </script>
  <script src="js/script.js"></script>

</body>

</html>