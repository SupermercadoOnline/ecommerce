<?php


class EstoqueProdutos
{

    private $idProduto;
    private $quantidade;
    private $dataMovimento;

    /**
     * EstoqueProdutos constructor.
     * @param $idProduto
     * @param $quantidade
     * @param $dataMovimento
     */
    public function __construct($idProduto, $quantidade, $dataMovimento)
    {
        $this->idProduto = $idProduto;
        $this->quantidade = $quantidade;
        $this->dataMovimento = $dataMovimento;
    }

    /**
     * @return mixed
     */
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * @param mixed $idProduto
     */
    public function setIdProduto($idProduto): void
    {
        $this->idProduto = $idProduto;
    }

    /**
     * @return mixed
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param mixed $quantidade
     */
    public function setQuantidade($quantidade): void
    {
        $this->quantidade = $quantidade;
    }

    /**
     * @return mixed
     */
    public function getDataMovimento()
    {
        return $this->dataMovimento;
    }

    /**
     * @param mixed $dataMovimento
     */
    public function setDataMovimento($dataMovimento): void
    {
        $this->dataMovimento = $dataMovimento;
    }

}