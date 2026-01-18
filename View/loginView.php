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
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controlle Login</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <div class="page">
    <div class="card page-card shadow-sm">

      <div id="mensagem" class="mb-3 text-center text-danger"></div>

      <div id="mensagem" class="mb-3 text-center"></div>

      <form id="form" action="../Controller/Dashboard.php" method="POST" class="custom-width">

        <h1 class="text-center mb-4">Login</h1>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input 
            type="email" 
            class="form-control" 
            id="email" 
            name="email" 
            placeholder="Digite seu email"
            data-required="true">
        </div>

        <div class="mb-3">
          <label class="form-label">Senha</label>
          <input 
            type="password" 
            class="form-control" 
            id="senha" 
            name="senha" 
            placeholder="Digite sua senha"
            data-required="true">
        </div>

        <button 
          type="submit" 
          class="btn btn-success w-100 mb-3" 
          id="btnEnviar">
          Entrar
        </button>

<<<<<<< Updated upstream
          <label>Senha:</label>

          <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" data-required="true">

        </div><br>


        <button type="submit" class="btn btn-primary  w-100 btn-success" id="btnEnviar">Entrar</button><br><br>

        <div class="text-center mt-3 mb-3">
=======
        <div class="text-center my-3">
>>>>>>> Stashed changes
          <hr>
          <span>ou</span>
        </div>

        <a 
          href="<?= $authUrl ?>" 
          class="btn btn-google w-100 d-flex align-items-center justify-content-center mb-3">
          Acessar com o Google
        </a>

        <div class="links">
          <p>Ainda não tem uma conta? <a href="cadastroView.php">Cadastre-se aqui</a></p>
          <p>Esqueceu sua senha? <a href="recuperarSenhaView.php">Clique aqui</a></p>
          <p>Deseja voltar ao início? <a href="../index.php">Clique aqui</a></p>
        </div>

      </form>
    </div>
  </div>

  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>

</body>
</html>
