<?php


$nomeUsuario = $_SESSION['usuario']['nome'];



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="View/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="View/css/dashboard.css">

  <title>Dashboard</title>
</head>

<body class="bg-light">
  <button id="menuToggle">☰</button>
  <nav id="sidebar">
    <div id="sidebar_content">
      <img src="View/img/logo_titulo.png" class="logo" alt="logo">

      <div id="user">
        <p id="user_infos">
          <span class="item-description">
            <?php echo 'Seja Bem-Vindo(a), '.  $nomeUsuario;?>
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
          <a href="View/addDispesasView.php">
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
      <a href="/git_controlle_financeiro/controlle_financeiro/Controller/Logout.php">
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
          Minhas Despesas
        </h1>
      </div>
    </nav>
  </header>

  <div id="backdrop"> </div>

<main class="container-fluid d-flex justify-content-center">
  <div class="mt-4 w-100 d-flex justify-content-center">
    <div class="bloco-principal p-3 shadow" style="max-width: 600px;">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <button class="btn btn-outline-secondary btn-sm rounded-circle" id="prev">
          <i class="bi bi-chevron-left"></i>
        </button>
        <strong id="mes" class="fs-5 text-uppercase">dezembro / 2025</strong>
        <button class="btn btn-outline-secondary btn-sm rounded-circle" id="next">
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>

      <div class="row g-3 mb-4">
        <div class="col-6">
          <div class="p-3 border-0 rounded-4 shadow-sm text-center" style="background-color: #f8f9fa;">
            <small class="text-muted d-block fw-bold mb-1" style="font-size: 0.65rem;">TOTAL DO MÊS</small>
            <h5 class="mb-0 fw-bold text-dark" id="total-estatico">R$ 0,00</h5>
          </div>
        </div>
        <div class="col-6">
          <div class="p-3 border-0 rounded-4 shadow-sm text-center" style="background-color: #fff5f5;">
            <small class="text-muted d-block fw-bold mb-1" style="font-size: 0.65rem;">SALDO DEVEDOR</small>
            <h5 class="mb-0 fw-bold text-danger" id="saldo-dinamico">R$ 0,00</h5>
          </div>
        </div>
      </div>
      
      <hr class="mb-4 opacity-25">

      <div id="lista-despesas">
        <?php foreach ($desp as $despesa): ?>
        <div class="despesa-card shadow-sm p-3 mb-3 border-0 rounded-4 bg-white"
            data-id="<?= $despesa['idDespesas']; ?>"
             data-valor="<?= $despesa['valor']; ?>" 
             data-status="<?= strtolower(trim($despesa['status'])); ?>">
          
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <h6 class="mb-1 fw-bold text-dark"><?= $despesa['descricao']; ?></h6>
              <p class="text-muted small mb-0">
                <i class="bi bi-calendar3 me-1"></i>
                <?= date('d/m/Y', strtotime($despesa['data_da_compra']));?>
              </p>
            </div>
            
            <div class="d-flex gap-2">
              <button class="btn-acao btn-edit text-secondary" data-id="<?= $despesa['idDespesas']; ?>">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button class="btn-acao btn-delete text-danger" data-id="<?= $despesa['idDespesas']; ?>">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </div>
          </div>

          <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
              <span class="fw-bold fs-5" style="color: var(--verde-moderno);">
                R$ <?= number_format($despesa['valor'], 2, ',', '.'); ?>
              </span>
              <span class="badge rounded-pill px-3 py-2" 
                    style="background: <?= ($despesa['status'] == 'Pago') ? '#d4edda' : '#fff3cd'; ?>; 
                           color: <?= ($despesa['status'] == 'Pago') ? '#155724' : '#856404'; ?>; 
                           font-size: 0.7rem;">
                  <i class="bi <?= ($despesa['status'] == 'Pago') ? 'bi-check-circle-fill' : 'bi-clock-history'; ?> me-1"></i>
                  <?= $despesa["status"];?>
              </span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</main>

  <script src="View/js/bootstrap.min.js"></script>
  <script src="View/js/script.js"></script>
  
  <!-- Modal para editar a despesas.-->
  <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
    <div class="modal-content" style="background-color: #1e1e1e; color: #fff; border: 1px solid #333;">
      <div class="modal-header" style="border-bottom: 1px solid #333;">
        <h5 class="modal-title w-100 text-center">Editar Despesa</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="container-do-modal">
        </div>
    </div>
  </div>
</div>
</body>

</html>