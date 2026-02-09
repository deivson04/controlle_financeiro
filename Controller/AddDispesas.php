<?php


namespace Controller;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Service\Fachada;
use Objeto\Despesas;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $nome_titu = trim($_POST['nomeTitu'] ?? '');
  $data = trim($_POST['data'] ?? '');
  $descricao = trim($_POST['descricao'] ?? '');
  $tipo_pagamento = trim($_POST['tipoPagamento'] ?? '');

  if ($tipo_pagamento === 'avista') {

    $avista = 1;

    // garante que o campo fica 0 ou nulo
    $parcelado = null;
  } elseif ($tipo_pagamento === 'parcelado') {

    $quantidadeParcelas = $_POST['quantidadeParcelas'];

    $parcelado = (int)$quantidadeParcelas;

    // garante que o campo fica 0 ou nulo
    $avista = null;
  }

  $valor = trim($_POST['valor'] ?? '');

  $idUsuario = $_SESSION['usuario']['idUsuario'];

  // validação lado do servido
  $erros = [];

  if (empty($nome_titu)) {
    $erros['nomeTitu'] = "O campo Titula do cartao é obrigatório.";
  }
  if (empty($data)) {
    $erros['data'] = "O campo Data é obrigatório.";
  }
  if (empty($descricao)) {
    $erros['descricao'] = "O campo descricao é obrigatório.";
  }
  if (empty($tipo_pagamento)) {
    $erros['$tipo_pagamento'] = "O campo pagamento é obrigatório.";
  }
  if (empty($valor)) {
    $erros['valor'] = "O campo valor é obrigatório.";
  }

  if (!empty($erros)) {
    echo 'Erros encontrados:<br>';
    foreach ($erros as $mensagem) {
      echo "- $mensagem<br>";
    }
    echo '<br><br><a href="../DashboardRota.php">Voltará pagina para adicionar</a>';
    exit();
  }

  $despesas = new Despesas();

  $despesas->setNome_titular($_POST['nomeTitu'] ?? '');
  $despesas->setData_da_compra($_POST['data'] ?? '');
  $despesas->setDescricao($_POST['descricao'] ?? '');
  $despesas->setAvista($avista);

  $despesas->setParcelado($parcelado);

  $despesas->setValor($_POST['valor'] ?? '');

  $despesas->setIdUsuario($idUsuario);


  // Instancia a Fachada e chama o método para inserir o usuário
  $fachada = new Fachada();

  $custo = $fachada->inserirDespesas($despesas);

  if ($custo) {

    echo 'Despesa cadastrada com sucesso';
  } else {

    echo 'Despesa não cadastrada';
  }
  echo '<br>';
  echo '<a href="../DashboardRota.php">Voltar</a>';
}
