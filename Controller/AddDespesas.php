<?php

namespace Controller;

header('Content-Type: application/json; charset=utf-8');

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Service\Fachada;
use Objeto\Despesas;

// O código só será executado se o método de envio for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $nome_titu = trim($_POST['nomeTitu'] ?? '');
  $data = trim($_POST['data'] ?? '');
  $dataAPagar = trim($_POST['dataAPagar'] ?? '');
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

  $valor = trim($_POST['valor'] ?? '0');
  
  // Remove "R$", pontos de milhar e troca a vírgula por ponto
$valorLimpos = preg_replace('/[^0-9,]/', '', $valor);
$valorLimpo = str_replace(',', '.', $valorLimpos);

$valorFinal = (float)$valorLimpo;

  $idUsuario = $_SESSION['usuario']['idUsuario'];

  // validação lado do servido
  $erros = [];

  if (empty($nome_titu)) {
    $erros['nomeTitu'] = "O campo Titula do cartao é obrigatório.";
  }
  if (empty($data)) {
    $erros['data'] = "O campo Data é obrigatório.";
  }
  if (empty($dataAPagar)) {
    $erros['dataAPagar'] = "O campo Data a pagar é obrigatório.";
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
    echo json_encode([
            'status' => 'error',
            'message' => implode(" ", $erros)
        ]);
        exit();
    }

  $despesas = new Despesas();

  $despesas->setNome_titular($nome_titu);
  $despesas->setData_da_compra($data);
  $despesas->setData_a_pagar($dataAPagar);
  $despesas->setDescricao($descricao);
  $despesas->setAvista($avista);

  $despesas->setParcelado($parcelado);

  $despesas->setValor($valorFinal);
  
  $despesas->setQuantidade_parcelas($quantidadeParcelas);

  $despesas->setIdUsuario($idUsuario);


  // Instancia a Fachada e chama o método para inserir o usuário
  $fachada = new Fachada();

  $custo = $fachada->inserirDespesas($despesas);

  if ($custo) {

    echo json_encode([
            'status' => 'success',
            'message' => 'Despesas cadastrada com sucesso!',
            'redirect' => 'DashboardRota.php'
        ]);
        exit;
  } else {

    echo json_encode([
            'status' => 'error', 
            'message' => 'Despesas não cadastrada.'
        ]);
        exit;
  }
 
}
