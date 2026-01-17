<?php

session_start();

if (!isset($_SESSION['logado']) || ($_SESSION['logado'] !== true)) {
  header('Location: loginView.php');
  exit();
} else {
  // O usuário está logado, você pode acessar os dados da sessão
  $nomeUsuario = $_SESSION["nome"] ?? 'Visitante';
  //$idGoogle = $_SESSION["id_google"] ?? null;


  //$idComun = $_SESSION["idUsuario"] ?? null;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard.css">

  <title>Dashboard</title>
</head>

<body class="bg-light">
  <button id="menuToggle">☰</button>
  <nav id="sidebar">
    <div id="sidebar_content">
      <img src="img/logo_titulo.png" class="logo" alt="logo">

      <div id="user">
        <p id="user_infos">
          <span class="item-description">
            <?php echo 'Seja Bem-Vindo(a), ' . $nomeUsuario; ?>
          </span>
        </p>
      </div>
      <ul id="side_items">
        <li class="side-item active">
          <a href="DashboardView.php">
            <i class="fa-solid fa-money-bill"></i>
            <span class="item-description">
              Dashboard
            </span>
          </a>
        </li>

        <li class="side-item">
          <a href="addDispesasView.php">
            <i class="fa-solid fa-money-bill"></i>
            <span class="item-description">
              Adicionar Dispesas
            </span>
          </a>
        </li>

        <!--<li class="side-item">
               <a href="#">
                  <i class="fa-solid fa-money-bill-1"></i>
                  <span class="item-description">
                     Custos Fixos
                  </span>
               </a>
            </li>

            <li class="side-item">
               <a href="#">
                  <i class="fa-solid fa-sack-dollar"></i>
                  <span class="item-description">
                     Custos futuros
                  </span>
               </a>
            </li>-->

        <li class="side-item">
          <a href="#">
            <i class="fa-solid fa-user"></i>
            <span class="item-description">
              Usuários ativos
            </span>
          </a>
        </li>
      </ul>
    </div>
    <div id="logout">
      <a href="../Controller/Logout.php">
        <button id="logout_btn">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span class="item-description">
            Logout
          </span>
        </button>
      </a>
    </div>
  </nav>
  <header>
    <nav class="bg-success navbar rounded-bottom navbar-expand-lg navbar-success shadow-sm py-5">
      <div class="container-fluid align-items-center">
        <h1 class="text-black mx-auto mb-0 position-absolute start-50 translate-middle-x">
          Minhas despesas
        </h1>
      </div>
    </nav>
  </header>

  <div id="backdrop"> </div>

  <main class="container-fluid d-flex justify-content-center align-items-center">
    <div class="d-flex justify-content-center mt-5">
      <div class="bloco-principal p-3 shadow">

        <!-- Navegação de mês -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <button class="btn btn-light" id="prev" style="margin: 10px;">
            <i class="bi bi-chevron-left"></i>
          </button>

          <strong id="mes" class="text-white">dezembro / 2025</strong>

          <button class="btn btn-light" id="next" style="margin: 10px;">
            <i class="bi bi-chevron-right"></i>
          </button>
        </div>
        <hr>

        <!-- Despesa -->
        <div class="container text-center">
          <h6 class="mb-1">Moto Compra 2 / 33</h6>
          <small class="text-muted d-block">05/12/2025</small>

          <hr class="my-2">

          <h6 class="mb-1">R$ 10.000,00</h6>
          <small class="text-success fw-bold">PAGO</small>
        </div>

        <div class="container text-center">
          <h6 class="mb-1">TV Compra 4 / 8</h6>
          <small class="text-muted d-block">14/06/2025</small>

          <hr class="my-2">

          <h6 class="mb-1">R$ 1.300,00</h6>
          <small class="text-success fw-bold">PAGO</small>
        </div>

        <div class="bg-success p-3 rounded">
          <div class="d-flex justify-content-between">
            <span>Total a pagar</span>
            <strong>R$ 10.000,00</strong>
          </div>

          <div class="d-flex justify-content-between">
            <span>Saldo a pagar</span>
            <strong>R$ 0,00</strong>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="js/script.js"></script>
</body>

</html>