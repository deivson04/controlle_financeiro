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
   <link rel="stylesheet" href="css/dashboard.css">
   <title>Dashboard</title>
</head>

<body>
   <button id="menuToggle">☰</button>
   <nav id="sidebar">
      <div id="sidebar_content">
         <div id="user">
            <!-- <img src="src/images/avatar.jpg" id="user_avatar" alt="Avatar"> -->
            <p id="user_infos">
               <span class="item-description">
                  <?php echo 'Olá, ' .  $nomeUsuario; ?>
               </span>
               <span class="item-description">
                  Bem-vindo(a)
               </span>
            </p>
         </div>
         <ul id="side_items">
            <li class="side-item active">
               <a href="#">
                  <i class="fa-solid fa-chart-line"></i>
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
         <a href="../Controller/logout.php">
            <button id="logout_btn">
               <i class="fa-solid fa-right-from-bracket"></i>
               <span class="item-description">
                  Logout
               </span>
            </button>
         </a>
      </div>
   </nav>
   
   <div id="backdrop"></div>

   <main>
      <h1>Título</h1>
   </main>
   
   <script src="js/script.js"></script>
</body>

</html>