<?php

namespace Service;

use Model\UsuariosRepository;
use Model\DespesasRepository;
use Model\GoogleAuthRepository;

class Fachada
{
    private $conn;
    private $desp;
    private $google;

    public function __construct()
    {
        $this->conn = new UsuariosRepository();
        $this->desp = new DespesasRepository();
        $this->google = new GoogleAuthRepository();
    }

    public function inserirUsuario($usuario)
    {

        return $this->conn->inserirUsuario($usuario);
    }

    public function buscarUsuarios($usuario)
    {
        $dadosDoBanco = $this->conn->buscarUsuarios($usuario);
        
        if (!$dadosDoBanco) {
            return false;
        }
        
        $hashDeSenha = $dadosDoBanco['senha'];
        $senhaBruta = $usuario->getSenha();
        
       if (password_verify($senhaBruta,$hashDeSenha)) 
       {
           return $dadosDoBanco;
       } else {
           return false;
       }
        
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

        $dadosGoogle =  $this->google->googleCallback($authCode);
        
        if (!$dadosGoogle || !isset($dadosGoogle['id_google'])) {
            return false;
        }
        
        $idGoogle = $dadosGoogle['id_google']; 
        $email = $dadosGoogle['email'];
        $nome = $dadosGoogle['nome'];
    
    //  BUSCA NO BANCO DE DADOS PELO GOOGLE ID (UsuarioRepository)
    // Usamos o método corrigido para a busca por ID do Google: buscarUsuariosGoogle
    $usuarioDB = $this->conn->buscarUsuariosGoogle($idGoogle);
    
    $idUsuarioInterno = null;
    
    if ($usuarioDB) {
        $idUsuarioInterno = $usuarioDB['idUsuario'];
    } else {
        // 5. USUÁRIO NOVO: Cadastra no banco e obtém o ID interno
        
        // Chamamos o método de inserção que salva o googleId (VARCHAR)
        $idUsuarioInterno = $this->conn->inserirUsuarioGoogle($idGoogle, $email, $nome);
        
        // Se a inserção falhar (por exemplo, erro de DB)
        if (!$idUsuarioInterno) {
             return false;
        }
    }
    
    return [
        'idUsuario'  => $idUsuarioInterno, // ID do SEU banco (INT)
        'id_google'   => $idGoogle,        // ID do Google (VARCHAR)
        'nome'        => $nome,
        
        'email'       => $email,
    ];
    
    
        
    }

    public function atualizarSenha($usuario)
    {

        return $this->conn->atualizarSenha($usuario);
    }
    
    //Despesas
    
    public function inserirDespesas($despesas)
    {

        return $this->desp->inserirDespesas($despesas);
    }
    
    public function buscarDespesas($id) {
        
        return $this->desp->buscarDespesas($id);
    }
    
    public function buscarDespesasPorId($id) {
        
        return $this->desp->buscarDespesasPorId($id);
    }
    
    public function deleteDespesas($idDespesas) {
        
        return $this->desp->deleteDespesas($idDespesas);
}

    public function atualizaDespesas($despesas) {
        
        return $this->desp->atualizaDespesas($despesas);
}

    public function atualizaStatus($despesas) {
        
        return $this->desp->atualizaStatus($despesas);
}
}