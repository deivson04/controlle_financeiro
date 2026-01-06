<?php

namespace Objeto;

class Usuario
{
    private $idUsuario;
    private $nome;
    private $email;
    private $senha;
    private $idGoogle;

    public function getIdUsuario()
    {

        return $this->idUsuario;
    }

    public function getNome()
    {

        return $this->nome;
    }

    public function getEmail()
    {

        return $this->email;
    }

    public function getSenha()
    {

        return $this->senha;
    }
    
    public function getIdGoogle()
    {

        return $this->idGoogle;
    }

    // metodo set

    public function setIdusuario($idUsuario)
    {

        $this->idUsuario = $idUsuario;
    }

    public function setNome($nome)
    {

        $this->nome = $nome;
    }

    public function setEmail($email)
    {

        $this->email = $email;
    }

    public function setSenha($senha)
    {

        $this->senha = $senha;
    }
    
    public function setIdGoogle($idGoogle)
    {

        $this->idGoogle = $idGoogle;
    }
}
