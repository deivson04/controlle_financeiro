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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard.css">

  <title>Dashboard</title>
</head>

<body class="backdrop-blur">
  <button id="menuToggle">☰</button>
  <nav id="sidebar">
    <div id="sidebar_content">
      <img src="img/logo_titulo.png" class="logo" alt="logo">

      <div id="user">
        <p id="user_infos">
          <span class="item-description">
            <?php echo 'Seja Bem-Vindo(a), ' .  $nomeUsuario; ?>
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
    <nav class="bg-dark navbar rounded-bottom navbar-expand-lg navbar-success shadow-sm py-5">
      <div class="container-fluid align-items-center">

        <h1 class="text-white mx-auto mb-0 position-absolute start-50 translate-middle-x">
          Minhas despesas
        </h1>

      </div>
    </nav>
  </header>

  <div id="backdrop"> </div>

  <main class="container-fluid d-flex justify-content-center align-items-center">
    <div class="bg-dark bg-opacity-75 rounded shadow p-4" style="height: 90dvh; width: 180dvh;">


    </div>
  </main>

  <footer class="bg-dark text-white rounded-top text-center py-4 mt-5">
    <p class="mb-0">
      © 2025 <span class="text-success fw-semibold">Controlle Financeiro</span> — Todos os direitos reservados.
    </p>
  </footer>



  <script src="js/script.js"></script>
</body>

</html>
