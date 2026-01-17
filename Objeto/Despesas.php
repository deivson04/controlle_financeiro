<?php

namespace Objeto;

class Despesas
{
    private $id_despesas;
    private $idUsuario;
    private $nome_titular;
    private $data_da_compra;
    private $descricao;
    private $parcelado;
    private $avista;
    private $valor;
   // private $status;

    public function getId_despesas()
    {

        return $this->id_despesas;
    }

    public function getIdUsuario()
    {

        return $this->idUsuario;
    }

    public function getNome_titular()
    {

        return $this->nome_titular;
    }
    
    public function getData_da_compra()
    {

        return $this->data_da_compra;
    }

    public function getDescricao()
    {

        return $this->descricao;
    }
    
    public function getParcelado()
    {

        return $this->parcelado;
    }
    
        public function getAvista()
    {

        return $this->avista;
    }
    
        public function getValor()
    {

        return $this->valor;
    }
    
       // public function getStatus()
   // {

      //  return $this->status;
   // }

    // metodo set

    public function setId_despesas($id_despesas)
    {

        $this->id_despesas = $id_despesas;
    }

    public function setIdUsuario($idUsuario)
    {

        $this->idUsuario = $idUsuario;
    }

    public function setNome_titular($nome_titular)
    {

        $this->nome_titular = $nome_titular;
    }
    
    public function setData_da_compra($data_da_compra)
    {

        $this->data_da_compra = $data_da_compra;
    }

    public function setDescricao($descricao)
    {

        $this->descricao = $descricao;
    }
    
    public function setParcelado($parcelado)
    {

        $this->parcelado = $parcelado;
    }
    
    public function setAvista($avista)
    {

        $this->avista = $avista;
    }
    
    public function setValor($valor)
    {

        $this->valor = $valor;
    }
    
    //public function setStatus($status)
   // {

        //$this->status = $status;
   // }
}
