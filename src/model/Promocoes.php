<?php

class Promocoes
{
    private $id;
    private $descricao;
    private $dataInicio;
    private $dataFim;
    private $dataCadastro;
    private $isAtiva;

    /**
     * Promocoes constructor.
     * @param $id
     * @param $descricao
     * @param $dataInicio
     * @param $dataFim
     * @param $dataCadastro
     * @param $isAtiva
     */
    public function __construct($id, $descricao, $dataInicio, $dataFim, $dataCadastro, $isAtiva)
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->dataCadastro = $dataCadastro;
        $this->isAtiva = $isAtiva;
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
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * @param mixed $dataInicio
     */
    public function setDataInicio($dataInicio): void
    {
        $this->dataInicio = $dataInicio;
    }

    /**
     * @return mixed
     */
    public function getDataFim()
    {
        return $this->dataFim;
    }

    /**
     * @param mixed $dataFim
     */
    public function setDataFim($dataFim): void
    {
        $this->dataFim = $dataFim;
    }

    /**
     * @return mixed
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * @param mixed $dataCadastro
     */
    public function setDataCadastro($dataCadastro): void
    {
        $this->dataCadastro = $dataCadastro;
    }

    /**
     * @return mixed
     */
    public function getIsAtiva()
    {
        return $this->isAtiva;
    }

    /**
     * @param mixed $isAtiva
     */
    public function setIsAtiva($isAtiva): void
    {
        $this->isAtiva = $isAtiva;
    }

}