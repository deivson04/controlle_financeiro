<?php

namespace Service;

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