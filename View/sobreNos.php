<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Sobre Nós </title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">


</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
      <div class="container d-flex align-items-center ">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
          <a class="navbar-brand p-0 m-0 " href="../index.php">
            <img class="logo" src="img/logo_titulo.png" alt="Logo" class="img-fluid">
          </a>
        </div>
        <button class=" navbar-toggler collapsed ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false">
          <span class="toggler-icon top-bar"></span>
          <span class="toggler-icon middle-bar"></span>
          <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center text-center" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="../index.php">Início</a></li>
            <li class="nav-item"><a class="nav-link active" href="sobreNos.php">Sobre</a></li>
          </ul>
          <a href="loginView.php" class="btn btn-outline-success bg-transparent border-1 ms-lg-3 fw-semibold">Login</a>
        </div>
      </div>
    </nav>
  </header>

  <main class="text-center py-5 bg-light">
    <h1>Sobre o projeto</h1>
    <div class="container py-5">
      <div class="row align-items-center">

        <div class="align-text-center">
          <p class="text-justify">
            O <strong>Controle Financeiro</strong> é uma plataforma desenvolvida com o propósito de ajudar usuários a organizarem e monitorarem suas despesas de forma simples, prática e eficiente. Nosso objetivo é centralizar as informações financeiras em um único ambiente, proporcionando uma visão clara dos gastos e facilitando o controle do orçamento no dia a dia.

Com uma interface intuitiva e acessível, o sistema foi pensado para atender desde usuários iniciantes até aqueles que buscam uma ferramenta funcional para acompanhar suas finanças com mais precisão. A plataforma incentiva o planejamento financeiro consciente, auxiliando na tomada de decisões mais seguras e no uso responsável dos recursos.

Além disso, priorizamos a segurança das informações, garantindo o armazenamento adequado dos dados e permitindo flexibilidade para futuras melhorias. O Controle Financeiro nasce como uma solução completa para quem busca mais organização, controle e clareza sobre sua vida financeira.
          </p>
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
  </main>

  <footer class="bg-dark text-white text-center py-4 mt-5">
    <p class="mb-0">
      © 2025 <span class="text-success fw-semibold">Controlle Financeiro</span> — Todos os direitos reservados.
    </p>
  </footer>

  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>

</body>



</html>
