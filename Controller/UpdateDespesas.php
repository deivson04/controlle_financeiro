<?php
namespace Controller;
require_once __DIR__ . '/../vendor/autoload.php';
use Service\Fachada;
use Objeto\Despesas;

ini_set('display_errors', 0);
error_reporting(E_ALL);

header('Content-Type: application/json');

// 1. Pegamos o ID (essencial para ambos os casos)
$id = $_POST['idDespesas'] ?? null;
$statusVindoDoJS = $_POST['status'] ?? null;

$despesas = new Despesas();
$despesas->setIdDespesas($id);
$fachada = new Fachada();

if ($statusVindoDoJS !== null) {
    // --- FLUXO DA BADGE (Troca rápida) ---
    $despesas->setStatus($statusVindoDoJS);
    $sucesso = $fachada->atualizaStatus($despesas);
} else {
    // --- FLUXO DO MODAL (Edição Completa) ---
    $nomeTitu   = $_POST['nomeTitu'] ?? null;
    $data       = $_POST['data'] ?? null;
    $dataAPagar       = $_POST['dataAPagar'] ?? null;
    $descricao  = $_POST['descricao'] ?? null;
    $valorOriginal = $_POST['valor'] ?? '0';
    $quantParcelas = $_POST['quantidadeParcelas'] ?? 1;
    $tipo       = $_POST['tipoPagamento'] ?? '';

    // Tratamos o valor para o banco (vírgula por ponto)
    //$valor = str_replace(',', '.', $valorOriginal);
    

    $avista    = ($tipo === 'avista') ? 1 : 0;
    $parcelado = ($tipo === 'parcelado') ? 1 : 0;
    
    if ($tipo === 'avista') {
        $quantParcelas = 1;
    }

    $despesas->setNome_titular($nomeTitu);
    $despesas->setData_da_compra($data);
    $despesas->setData_a_pagar($dataAPagar);
    $despesas->setDescricao($descricao);
    $despesas->setParcelado($parcelado);
    $despesas->setAvista($avista);
    $despesas->setValor($valorOriginal);
    $despesas->setQuantidade_parcelas($quantParcelas);
    
    $sucesso = $fachada->atualizaDespesas($despesas);
}

echo json_encode(['status' => $sucesso ? 'success' : 'error']);