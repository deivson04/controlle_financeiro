<?php

namespace Controller;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use Service\Fachada;
use Objeto\Despesas;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idDespesas'])) {
    //$id = intval($_POST['idUsuario']);
    $idUsuario = $_SESSION['usuario']['idUsuario']; // Segurança: verificar se pertence ao usuário.
    $idDespesas = new Despesas();
    
     $idDespesas->setIdDespesas($_POST['idDespesas']);
    
    $fachada = new Fachada();
    
    $delete = $fachada ->deleteDespesas($idDespesas);


    //$sucesso = true; // Simulação de sucesso para teste

    if ($delete) {
        echo json_encode(['status' => 'success', 'message' => 'Despesa excluída!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar no banco.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Requisição inválida.']);
}