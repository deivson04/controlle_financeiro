<?php

//require_once "Config/conexao.php";
 //require_once __DIR__ . '/vendor/autoload.php';

use Controller\DashboardDespesas;

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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-2 ">
      <div class="container d-flex align-items-center">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
          <a class="navbar-brand p-0 m-0" href="index.php">
            <img class="logo" src="View/img/logo_titulo.png" alt="Logo">
          </a>
        </div>
        <button class="navbar-toggler collapsed ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false">
          <span class="toggler-icon top-bar"></span>
          <span class="toggler-icon middle-bar"></span>
          <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end text-center" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="index.php">Início</a></li>
            <li class="nav-item"><a class="nav-link" href="View/sobreNos.php">Sobre</a></li>
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
          <h2 class="fw-bold mb-3">Assuma o controlle total das suas despesas</h2>
          <a href="View/loginView.php" class="btn btn-success">
            Começar a controllar agora
          </a>
        </div>

        <div class="col-md-5 text-center">
          <img src="View/img/image_index.jpg" alt="Imagem ilustrativa" class="img-fluid rounded shadow-sm">
        </div>

      </div>
    </div>
    <div class="container my-4">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="p-4 text-center border border-secondary rounded bg-light" style="height: 60px;">
          </div>
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
            <h5 class="fw-bold">Controlle suas despesas</h5>
            <p class="text-muted">Registre, acompanhe e organize seus gastos de forma prática e intuitiva.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-md p-4 h-100">
            <div class="mb-3">
              <i class="bi bi-graph-up-arrow text-success display-4"></i>
            </div>
            <h5 class="fw-bold">Controlle seus gastos</h5>
            <p class="text-muted">Acompanhe suas despesas,identifique excessos e mantenha seu orçamento sempre sob controlle de forma simples e organizada.</p>
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
        © 2026 <span class="text-success fw-semibold">Controlle Financeiro</span> — Todos os direitos reservados.
      </p>
    </div>
  </footer>

  <script src="View/js/bootstrap.min.js"></script>
  <script src="View/js/script.js"></script>

</body>

</html>
