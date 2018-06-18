<?php

class Vendas{

    private $id;
    private $id_pessoa;
    private $data_venda;
    private $is_cliente_buscar;
    private $data_cliente_agendou_entrega;
    private $is_cancelada;

    public function __construct($id, $id_pessoa, $data_venda, $is_cliente_buscar, $data_cliente_agendou_entrega, $is_cancelada)
    {
        $this->id = $id;
        $this->id_pessoa = $id_pessoa;
        $this->data_venda = $data_venda;
        $this->is_cliente_buscar = $is_cliente_buscar;
        $this->data_cliente_agendou_entrega = $data_cliente_agendou_entrega;
        $this->is_cancelada = $is_cancelada;
    }

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

    public function getDataClienteAgendouEntrega()
    {
        return $this->data_cliente_agendou_entrega;
    }

    public function setDataClienteAgendouEntrega($data_cliente_agendou_entrega): void
    {
        $this->data_cliente_agendou_entrega = $data_cliente_agendou_entrega;
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