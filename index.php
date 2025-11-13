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
        <a class="navbar-brand fw-bold" href="index.php">
          <img src="img/logo.svg" alt="Logo" width="90" height="90" class="d-inline-block align-text-center me-2">
          Controlle Financeiro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center text-center" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="#">Início</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Sobre</a></li>
          </ul>
          <a href="View/loginView.php" class="btn btn-outline-success bg-transparent border-1 ms-lg-3 fw-semibold">Login</a>
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

  </main>
  <footer class="bg-dark text-white text-center py-4 mt-5">
    <div class="container">
      <h2 class="text-success mb-4 fw-bold">Dúvidas? Entre em contato</h2>

      <form class="mx-auto" style="max-width: 500px;">
        <div class="mb-3">
          <input type="text" id="name" name="name" class="form-control" placeholder="Seu nome" required>
        </div>

        <div class="mb-3">
          <textarea id="description" name="description" class="form-control" rows="4" placeholder="Descreva sua dúvida ou mensagem" required></textarea>
        </div>

        <button type="submit" class="btn btn-outline-success w-100">Enviar</button>
      </form>

      <hr class="border-secondary my-4">

      <p class="mb-0">
        © 2025 <span class="text-success fw-semibold">Controlle Financeiro</span> — Todos os direitos reservados.
      </p>
    </div>
  </footer>

  <script src="View/js/bootstrap.min.js"></script>
  <script src="View/js/script.js"></script>

</body>

</html>
