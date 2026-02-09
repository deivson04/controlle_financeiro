<?php

namespace Controller;

use Service\Fachada;
use Objeto\Despesas;

class DashboardDespesas {
    
    private $fachada;
    
    public function __construct() {
        
        $this->fachada = new Fachada();
        
    }

    public function buscarDespesas($despesas) {
        
        $id = new Despesas();
        $id->setIdUsuario($despesas);
        
        $desp = $this->fachada->buscarDespesas($id);
        
        
         require __DIR__ . '/../View/DashboardView.php';
    }
}