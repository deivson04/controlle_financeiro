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

        $sql = "INSERT INTO despesas (nome_titular, data_da_compra, descricao, parcelado, avista, valor, idUsuario) 
            VALUES (:nome_titular, :data_da_compra, :descricao, :parcelado, :avista, :valor, :idUsuario)";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(":nome_titular", $nomeTitu);
        $stmt->bindParam(":data_da_compra", $data);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":parcelado", $parcelado);
        $stmt->bindParam(":avista", $avista);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":idUsuario", $idUsuario);

        $stmt->execute();


        return $stmt;
    }


public function buscarDespesas($id) {
    
    $idUsuario = $id->getIdUsuario();
    
    $sql = "SELECT idDespesas, descricao, data_da_compra, valor, status, quantidade_parcelas 
           FROM despesas
           WHERE idUsuario = :idUsuario";
           

    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(":idUsuario", $idUsuario);
        
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function buscarDespesasPorId($id) {
    
    $idDespesas = $id->getIdDespesas();
    
    $sql = "SELECT * 
           FROM despesas
           WHERE idDespesas = :idDespesas";
           

    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(":idDespesas", $idDespesas);
        
        $stmt->execute();

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$dados) return null;

    // Lógica para marcar o Radio Button correto na View
    // Se a coluna 'avista' for 1 (true), mandamos a string "checked", senão vazio
    $dados['check_avista']    = ($dados['avista'] == 1) ? 'checked' : '';
    $dados['check_parcelado'] = ($dados['parcelado'] == 1) ? 'checked' : '';
    return $dados;

  }
  
  public function deleteDespesas($idDespesas) {
     
      $idDesp = $idDespesas->getIdDespesas();
      
      $sql = "DELETE FROM despesas 
              WHERE idDespesas = :idDesp";
              
      $stmt = $this->con->prepare($sql);
      $stmt->bindParam(":idDesp", $idDesp);
      
      return $stmt->execute();
  }
  
  public function atualizaDespesas($despesas) {
     
    $idDesp    = $despesas->getIdDespesas();
    $nomeTitu  = $despesas->getNome_titular();
    $data      = $despesas->getData_da_compra();
    $descricao = $despesas->getDescricao();
    $parcelado = $despesas->getParcelado();
    $avista    = $despesas->getAvista();
    $valor     = $despesas->getValor();
    $qtdParc = $despesas->getQuantidade_parcelas();
    
    $sql = "UPDATE despesas SET 
                nome_titular = :nomeTitu, 
                data_da_compra = :data, 
                descricao = :descricao, 
                parcelado = :parcelado, 
                avista = :avista, 
                valor = :valor,
                quantidade_parcelas = :qtdParc
            WHERE idDespesas = :idDesp";
            
    $stmt = $this->con->prepare($sql);
    
    $stmt->bindParam(":idDesp", $idDesp);
    $stmt->bindParam(":nomeTitu", $nomeTitu);
    $stmt->bindParam(":data", $data);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":parcelado", $parcelado);
    $stmt->bindParam(":avista", $avista);
    $stmt->bindParam(":valor", $valor);
    $stmt->bindParam(":qtdParc", $qtdParc);
    
    return $stmt->execute();
}

 
public function atualizaStatus($despesas) {
        
        $status = $despesas->getStatus();
       
        $idDespesas = $despesas->getIdDespesas();
        
        $sql = "UPDATE despesas SET status = :status WHERE idDespesas = :idDespesas";
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':idDespesas', $idDespesas);
        
        return $stmt->execute();
    } 
}
