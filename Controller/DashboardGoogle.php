<?php

namespace Controller;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use Service\Fachada;

// 🔒 BLOQUEIA acesso direto
if (!isset($_GET['code'])) {
  header('Location: ../View/loginView.php');
  exit;
}

$fachada = new Fachada();

// 1. Valida o código no Google
$dadosUsuario = $fachada->googleCallback($_GET['code']);

// 2. Se falhar, volta pro login
if (
  !$dadosUsuario ||
  !isset($dadosUsuario['nome'], $dadosUsuario['id_google'], $dadosUsuario['email'])
) {
  header('Location: ../View/loginView.php');
  exit;
}

// 3. Cria sessão (login REAL)
$_SESSION['logado'] = true;
$_SESSION['usuario'] = [
  'idUsuario' => $dadosUsuario['idUsuario'], // ID do SEU banco (INT)
  'nome'  => $dadosUsuario['nome'],
  'id'    => $dadosUsuario['id_google'],
  'email' => $dadosUsuario['email']
];

// 4. Segurança extra
unset($_GET['code']);

// 5. Redireciona
header('Location: ../DashboardRota.php');
exit;
