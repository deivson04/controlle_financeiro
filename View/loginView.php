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

  <link href="css/style.css" rel="stylesheet">

</head>

<body>

  <div class="container-fluid d-flex justify-content-center align-items-center full-height custom-bg">

    <div class="border p-4 rounded shadow-sm custom-width">

      <div id="mensagem" class="mb-3 text-center"></div>

      <form id="form" action="../Controller/dashboard.php" method="POST" class="custom-width">

        <h1 class="text-center mb-4">Controlle Login</h1>

        <div class="form-group">

          <label>Email:</label>

          <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" data-required="true">

        </div>


        <div class="form-group">

          <label>senha:</label>

          <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" data-required="true">

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
  <script src="js/script.js"></script>

</body>

</html>
