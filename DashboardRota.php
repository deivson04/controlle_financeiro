<?php
session_start();

require __DIR__ . '/vendor/autoload.php';

use Controller\DashboardDespesas;

// proteção de rota
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: View/loginView.php');
    exit;
}

// envia a sessão do usuario 
$idUsuario = $_SESSION['usuario']['idUsuario'];

$mes = $_GET['mes'] ?? date('m');
$ano = $_GET['ano'] ?? date('Y');

// chama o controller
$controller = new DashboardDespesas();
$controller->buscarDespesas($idUsuario, $mes, $ano);
