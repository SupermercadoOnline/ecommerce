<?php

class ProdutosVenda{

    private $id_venda;
    private $id_produto;
    private $quantidade_produto;
    private $preco_produto_data_venda;

    public function __construct($id_venda, $id_produto, $quantidade_produto, $preco_produto_data_venda)
    {
        $this->id_venda = $id_venda;
        $this->id_produto = $id_produto;
        $this->quantidade_produto = $quantidade_produto;
        $this->preco_produto_data_venda = $preco_produto_data_venda;
    }

    public function getIdVenda()
    {
        return $this->id_venda;
    }

    public function setIdVenda($id_venda): void
    {
        $this->id_venda = $id_venda;
    }

    public function getIdProduto()
    {
        return $this->id_produto;
    }

    public function setIdProduto($id_produto): void
    {
        $this->id_produto = $id_produto;
    }

    public function getQuantidadeProduto()
    {
        return $this->quantidade_produto;
    }

    public function setQuantidadeProduto($quantidade_produto): void
    {
        $this->quantidade_produto = $quantidade_produto;
    }

    public function getPrecoProdutoDataVenda()
    {
        return $this->preco_produto_data_venda;
    }

    public function setPrecoProdutoDataVenda($preco_produto_data_venda): void
    {
        $this->preco_produto_data_venda = $preco_produto_data_venda;
    }

}