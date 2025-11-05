<?php

 //require_once "Config/conexao.php";
// require_once __DIR__ . '/vendor/autoload.php';

 //use Config\Conexao;

 //$return = new Conexao();
 //$re = $return->conectar();

 //if ($re) {
     //echo 'conexao ok';
// }else {
    // echo 'conexao falhou';
// }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controlle Financeiro</title>
    <link rel="stylesheet" href="View/css/bootstrap.min.css">
    <link rel="stylesheet" href="View/css/style.css">
</head>
<body>
    <header> 
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
          <a class="navbar-brand fw-bold text-center" href="index.php">
          <img src="View/img/logo.svg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top me-2">
        Controlle Financeiro
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link active" href="#">Início</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Sobre</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Contato</a></li>
            </ul>
            <a href="View/loginView.php" class="btn btn-success ms-lg-3">Login</a>
          </div>
        </div>
      </nav>        
    </header>

    <main>
      <div> 
        <h2>Comece a controlar suas finanças em um só lugar</h2>
        <a href="View/loginView.php" class="btn btn-success">Começar a controlar agora</a>
      </div>

      <img src="View/img/image.jpg" class="img-fluid rounded shadow" alt="imagem">
    </main>

    <footer class="bg-dark text-white text-center py-3">
          <p>© 2025 Controlle Financeiro - Todos os direitos reservados </p>
    </footer>

    <script src="View/js/bootstrap.min.js"></script>
    <script src="View/js/script.js"></script>
</body>
</html>
