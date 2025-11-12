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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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

  <main class="text-center py-5 bg-light">

    <div class="container">
      <div class="row align-items-center justify-content-center">

        <div class="col-md-6 text-md-start text-center mb-4 mb-md-0">
          <h2 class="fw-bold mb-3">Assuma o controle total das suas finanças</h2>
          <a href="View/loginView.php" class="btn btn-success">
            Começar a controlar agora
          </a>
        </div>

        <div class="col-md-5 text-center">
          <img src="img/image.jpg" alt="Imagem ilustrativa" class="img-fluid rounded shadow-sm">
        </div>

      </div>
    </div>

    <div class="container">
      <div class="row justify-content-center g-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-md p-4 h-100">
            <div class="mb-3">
              <i class="bi bi-shield-check text-success display-4"></i>
            </div>
            <h5 class="fw-bold">Segurança Total</h5>
            <p class="text-muted">Seus dados sempre protegidos com criptografia e autenticação segura.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-md p-4 h-100">
            <div class="mb-3">
              <i class="bi bi-graph-up-arrow text-success display-4"></i>
            </div>
            <h5 class="fw-bold">Metas de Economia</h5>
            <p class="text-muted">Defina e alcance suas metas financeiras de forma simples e intuitiva.</p>
          </div>
        </div>
      </div>
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
