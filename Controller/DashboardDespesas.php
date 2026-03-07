<?php

namespace Controller;

use Service\Fachada;
use Objeto\Despesas;

class DashboardDespesas {
    
    private $fachada;
    
    public function __construct() {
        
        $this->fachada = new Fachada();
        
    }

    public function buscarDespesas($idUsuario, $mes, $ano) {
        
        $id = new Despesas();
        $id->setIdUsuario($idUsuario);
        
        $desp = $this->fachada->buscarDespesas($id, $mes, $ano);
        
        
         require __DIR__ . '/../View/DashboardView.php';
    }
}