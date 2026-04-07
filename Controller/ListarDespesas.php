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

 foreach ($desp as $despesa) {
    // CHAMA O COMPONENTE ÚNICO
    include __DIR__ . '/../View/blockCard/cardDespesas.php';
}