<?php

namespace Controller;
//var_dump($_POST);
//die;

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
  $quantidadeParcelas =trim($_POST['quantidade_parcelas'] ?? '');


  if ($tipo_pagamento === 'avista') {

    $avista = 1;
    $parcelado = 0;
    $quantidadeParcelas = 1;
    
    
  } elseif ($tipo_pagamento === 'parcelado') {

    
    $quantidadeParcelas = (int)($_POST['quantidade_parcelas'] ?? 1);

    $avista = 0;
    $parcelado = 1;
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
  
  $despesas->setQuantidade_parcelas($quantidadeParcelas);

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
