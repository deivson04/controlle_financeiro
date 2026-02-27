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
        $quantidade_parcelas = $despesas->getQuantidade_parcelas();

        $sql = "INSERT INTO despesas (nome_titular, data_da_compra, descricao, parcelado, avista, valor, idUsuario, quantidade_parcelas) 
            VALUES (:nome_titular, :data_da_compra, :descricao, :parcelado, :avista, :valor, :idUsuario, :quantidade_parcelas)";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(":nome_titular", $nomeTitu);
        $stmt->bindParam(":data_da_compra", $data);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":parcelado", $parcelado);
        $stmt->bindParam(":avista", $avista);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":idUsuario", $idUsuario);
        $stmt->bindParam(":quantidade_parcelas", $quantidade_parcelas);

        $stmt->execute();


        return $stmt;
    }


public function buscarDespesas($id, $mes ,$ano) {
    
    $dataFiltro = "$ano-$mes-01";
    
    $idUsuario = is_object($id) ? $id->getIdUsuario() : $id;
    
    $sql = "SELECT *, 
    -- Cálculo da parcela atual
    (TIMESTAMPDIFF(MONTH, DATE_FORMAT(data_da_compra, '%Y-%m-01'), :dataFiltro1) + 1) as parcela_atual
FROM despesas
WHERE idUsuario = :idUsuario 
AND (
    -- REGRA 1: À VISTA (Só aparece se o mês/ano for igual à compra)
    (avista = 1 AND DATE_FORMAT(data_da_compra, '%Y-%m') = DATE_FORMAT(:dataFiltro2, '%Y-%m'))
    
    OR 
    
    -- REGRA 2: PARCELADO
    (parcelado = 1 
    
     AND (TIMESTAMPDIFF(MONTH, DATE_FORMAT(data_da_compra, '%Y-%m-01'), :dataFiltro3) + 1) >= 1
     AND (TIMESTAMPDIFF(MONTH, DATE_FORMAT(data_da_compra, '%Y-%m-01'), :dataFiltro4) + 1) <= quantidade_parcelas)
)
ORDER BY data_da_compra DESC";

    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(":idUsuario", $idUsuario);
    //$stmt->bindParam(":mes", $mes);
    //$stmt->bindParam(":ano", $ano);
    $stmt->bindParam(":dataFiltro1", $dataFiltro);
    $stmt->bindParam(":dataFiltro2", $dataFiltro);
    $stmt->bindParam(":dataFiltro3", $dataFiltro);
    $stmt->bindParam(":dataFiltro4", $dataFiltro);
        
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
