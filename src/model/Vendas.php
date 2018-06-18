<?php

class Vendas{
    private $id;
    private $id_pessoa;
    private $data_venda;
    private $is_cliente_buscar;
    private $is_cancelada;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIdPessoa()
    {
        return $this->id_pessoa;
    }

    public function setIdPessoa($id_pessoa): void
    {
        $this->id_pessoa = $id_pessoa;
    }

    public function getDataVenda()
    {
        return $this->data_venda;
    }

    public function setDataVenda($data_venda): void
    {
        $this->data_venda = $data_venda;
    }

    public function getIsClienteBuscar()
    {
        return $this->is_cliente_buscar;
    }

    public function setIsClienteBuscar($is_cliente_buscar): void
    {
        $this->is_cliente_buscar = $is_cliente_buscar;
    }

    public function getIsCancelada()
    {
        return $this->is_cancelada;
    }

    public function setIsCancelada($is_cancelada): void
    {
        $this->is_cancelada = $is_cancelada;
    }

}