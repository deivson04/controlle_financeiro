<?php
namespace Controller;

require_once __DIR__ . '/../vendor/autoload.php';

use Service\Fachada;
use Objeto\Despesas;

$id = new Despesas();

$id->setIdDespesas($_GET['idDespesas']);
if ($id) {
    
    $fachada = new Fachada();
    
    $despesa = $fachada->buscarDespesasPorId($id); 
    
    // Passa o objeto para a View
    require __DIR__ . '/../View/updateView.php';
} else {
    echo 'Error objeto não encontrado!';
}