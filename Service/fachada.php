<?php

namespace Service;

use Model\UsuariosRepository;
use Model\GoogleAuthRepository;

class Fachada
{

    private $conn;
    private $google;

    public function __construct()
    {
        $this->conn = new UsuariosRepository();
        $this->google = new GoogleAuthRepository();
    }

    public function inserirUsuario($usuario)
    {

        return $this->conn->inserirUsuario($usuario);
    }

    public function buscarUsuarios($usuario)
    {


        return $this->conn->buscarUsuarios($usuario);
    }

    public function buscarUsuarioPorEmail($usuario)
    {
        return $this->conn->buscarUsuarioPorEmail($usuario);
    }

    public function googleAuthLogin()
    {

        return $this->google->googleAuthLogin();
    }

    public function googleCallback($authCode)
    {

        return $this->google->googleCallback($authCode);
    }

    public function atualizarSenha($usuario)
    {

        return $this->conn->atualizarSenha($usuario);
    }
}
