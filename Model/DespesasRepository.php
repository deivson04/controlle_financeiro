<?php

namespace Model;

use PDO;
use Config\Conexao;

class DespesasRepository
{

    protected $con;

    public function __construct()
    {

        $conexao = new Conexao();

        $this->con = $conexao->conectar();

        // if ($this->con === null || $this->con === false) {
        // die("Erro: Não foi possível conectar ao banco de dados. Verifique a classe Conexao.");
        //  }

    }
    
    public function inserirDespesas($despesas)
    {


      $nomeTitu = $despesas->getNome_titular();
       $data = $despesas->getData_da_compra();
       $descricao = $despesas->getDescricao();
       $parcelado = $despesas->getParcelado();
       $avista = $despesas->getAvista();
       $valor = $despesas->getValor();
       $idUsuario = $despesas->getIdUsuario();




        $sql = "INSERT INTO despesas (nome_titular, data_da_compra, descricao, parcelado, avista, valor, fk_idUsuario) 
            VALUES (:nome_titular, :data_da_compra, :descricao, :parcelado, :avista, :valor, :fk_idUsuario)";

        $stmt = $this->con->prepare($sql);
        
        $stmt->bindParam(":nome_titular", $nomeTitu);
        $stmt->bindParam(":data_da_compra", $data);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":parcelado", $parcelado);
        $stmt->bindParam(":avista", $avista);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":fk_idUsuario", $idUsuario);
        
        $stmt->execute();

        return $stmt;
    }
}