<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
use Service\Fachada;

$idUsuario = $_SESSION['usuario']['idUsuario'];
$mes = $_GET['mes'] ?? date('m');
$ano = $_GET['ano'] ?? date('Y');

$fachada = new Fachada();

$desp = $fachada->buscarDespesas($idUsuario, $mes, $ano);

if (empty($desp)) {
    echo '<p class="text-center text-muted">Nenhuma despesa para este mês.</p>';
    exit;
}

 foreach ($desp as $despesa): 
              $p_atual = (int)$despesa['parcela_atual'];
              $p_pagas_banco = (int)$despesa['status']; 
              $estaPago = ($p_atual <= $p_pagas_banco);

              $corFundo = $estaPago ? '#d4edda' : '#fff3cd';
              $corTexto = $estaPago ? '#155724' : '#856404';
              $textoStatus = $estaPago ? 'Pago' : 'A Pagar';
              $iconeStatus = $estaPago ? 'bi-check-circle-fill' : 'bi-clock-history';
          ?>

          <div class="despesa-card shadow-sm p-3 mb-3 border-0 rounded-4 bg-white"
              data-id="<?= $despesa['idDespesas']; ?>"
              data-valor="<?= $despesa['valor']; ?>" 
              data-p-atual="<?= $p_atual; ?>"
              data-p-pagas="<?= $p_pagas_banco; ?>"> 
              
              <div class="d-flex justify-content-between align-items-start">
                  <div>
                      <h6 class="mb-1 fw-bold text-dark"><?= $despesa['nome_titular']; ?></h6>
                      <h6 class="mb-1 fw-bold text-dark"><?= $despesa['descricao']; ?></h6>
                      <h6 class="mb-1 fw-bold text-dark">
                          <?= ($despesa['avista'] == 1) ? 'À Vista' : $p_atual . '/' . $despesa['quantidade_parcelas'] . 'x'; ?>
                      </h6>
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
                  <span class="badge rounded-pill px-3 py-2 badge-status-clicavel" 
                          style="background: <?= $corFundo ?>; color: <?= $corTexto ?>; font-size: 0.7rem; cursor: pointer;">
                      <i class="bi <?= $iconeStatus ?> me-1"></i>
                      <?= $textoStatus; ?>
                  </span>
              </div>
          </div> 
          <?php endforeach; ?>