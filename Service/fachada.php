<?php

namespace Service;

require_once '../Model/repositoryUsuario.php';

use Model\UsuariosRepository;

class Fachada {
    
    public function inserirUsuario($usuario) {
       
        $conn = new UsuariosRepository();

        return $conn->inserirUsuario($usuario);

    
    }

    public function buscarUsuarios($usuario) {
       
        $conn = new UsuariosRepository();
        
        return $conn->buscarUsuarios($usuario);
    
    }
}