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
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet">

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
        <button class="navbar-toggler collapsed ms-auto" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarNav" aria-expanded="false">
          <span class="toggler-icon top-bar"></span>
          <span class="toggler-icon middle-bar"></span>
          <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end text-center" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="index.php">Início</a></li>
            <li class="nav-item"><a class="nav-link" href="View/sobreNos.php">Sobre</a></li>
          </ul>
          <a href="View/loginView.php"
            class="btn btn-outline-success bg-transparent border-1 ms-lg-3 fw-semibold">Login</a>
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
          <img src="View/img/img_index.png" alt="Imagem ilustrativa" class="img-fluid rounded">
        </div>

      </div>
    </div>
    <div class="container my-4">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <!-- <div class="p-4 text-center border border-secondary rounded bg-light" style="height: 60px;"> -->

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
            <p class="text-muted">Acompanhe suas despesas,identifique excessos e mantenha seu orçamento sempre sob
              controlle de forma simples e organizada.</p>
          </div>
        </div>
      </div>
    </div>

  </main>

  <div class="modal fade" id="privacyModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Política de Privacidade</h5>
        </div>

        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
          <p>
            Este sistema de controle financeiro coleta e armazena informações fornecidas pelo usuário,
            como dados de receitas, despesas e preferências, com o objetivo de melhorar a experiência
            e organização financeira.
          </p>

          <p>
            Seus dados não serão compartilhados com terceiros sem consentimento, exceto quando exigido por lei.
          </p>

          <p>
            Utilizamos medidas de segurança para proteger suas informações contra acessos não autorizados.
          </p>

          <p>
            Ao utilizar este sistema, você concorda com o armazenamento e uso dessas informações.
          </p>
        </div>

        <div class="modal-footer flex-column align-items-start">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="acceptPrivacy">
            <label class="form-check-label">
              Eu li e aceito a Política de Privacidade
            </label>
          </div>

          <button id="btnAccept" class="btn btn-success mt-2" disabled>
            Aceitar
          </button>
        </div>

      </div>
    </div>
  </div>

  <footer class="bg-dark text-light pt-5 pb-3">
    <div class="container">

      <div class="row">

        <div class="col-md-6 mb-4 text-center text-md-start">
          <h5 class="text-success">Links úteis</h5>

          <ul class="list-unstyled">
            <li><a href="View/sobreNos.php" class="text-decoration-none text-light">› Sobre nós</a></li>
            <li><a href="View/guiaUsuario.php" class="text-decoration-none text-light">› Guia do usuário</a></li>
            <li><a href="#" class="text-decoration-none text-light" id="openPrivacy">› Política de privacidade</a></li>
          </ul>
        </div>

        <div class="col-md-6 mb-4">
          <div class="d-flex align-items-center">
            <img src="View/img/logo.svg" width="85" class="me-3">
            <div>
              <h4 class="text-white mb-1">Controlle Financeiro</h4>
              <p class="text-secondary mb-0">
                Sistema para gerenciar suas despesas.
              </p>
            </div>
          </div>
        </div>
      </div>

      <hr class="border-secondary">

      <div class="text-center">
        <p class="mb-0">
          © 2026 <span class="text-success">Controle Financeiro</span> — Todos os direitos reservados.
        </p>
      </div>

    </div>
  </footer>

  <script src="View/js/bootstrap.min.js"></script>
  <script src="View/js/script.js"></script>
  <script src="View/js/politicas_privacidade.js"></script>

</body>

</html>