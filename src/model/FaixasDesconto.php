<?php

class FaixasDesconto
{
    private $id;
    private $idPromocao;
    private $atePrecoProduto;
    private $percentualDesconto;

    /**
     * FaixasDesconto constructor.
     * @param $id
     * @param $idPromocao
     * @param $atePrecoProduto
     * @param $percentualDesconto
     */
    public function __construct($id, $idPromocao, $atePrecoProduto, $percentualDesconto)
    {
        $this->id = $id;
        $this->idPromocao = $idPromocao;
        $this->atePrecoProduto = $atePrecoProduto;
        $this->percentualDesconto = $percentualDesconto;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdPromocao()
    {
        return $this->idPromocao;
    }

    /**
     * @param mixed $idPromocao
     */
    public function setIdPromocao($idPromocao): void
    {
        $this->idPromocao = $idPromocao;
    }

    /**
     * @return mixed
     */
    public function getAtePrecoProduto()
    {
        return $this->atePrecoProduto;
    }

    /**
     * @param mixed $atePrecoProduto
     */
    public function setAtePrecoProduto($atePrecoProduto): void
    {
        $this->atePrecoProduto = $atePrecoProduto;
    }

    /**
     * @return mixed
     */
    public function getPercentualDesconto()
    {
        return $this->percentualDesconto;
    }

    /**
     * @param mixed $percentualDesconto
     */
    public function setPercentualDesconto($percentualDesconto): void
    {
        $this->percentualDesconto = $percentualDesconto;
    }

}