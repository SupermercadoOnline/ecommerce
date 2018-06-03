<?php

class EnderecosBean
{
    private $id;
    private $idPessoa;
    private $idCidade;
    private $rua;
    private $bairro;
    private $numero;
    private $cep;
    private $complemento;
    private $isAtivo;

    /**
     * EnderecosBean constructor.
     * @param $id
     * @param $idPessoa
     * @param $idCidade
     * @param $rua
     * @param $bairro
     * @param $numero
     * @param $cep
     * @param $complemento
     * @param $isAtivo
     */
    public function __construct($id, $idPessoa, $idCidade, $rua, $bairro, $numero, $cep, $complemento, $isAtivo)
    {
        $this->id = $id;
        $this->idPessoa = $idPessoa;
        $this->idCidade = $idCidade;
        $this->rua = $rua;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->cep = $cep;
        $this->complemento = $complemento;
        $this->isAtivo = $isAtivo;
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
    public function getIdPessoa()
    {
        return $this->idPessoa;
    }

    /**
     * @param mixed $idPessoa
     */
    public function setIdPessoa($idPessoa): void
    {
        $this->idPessoa = $idPessoa;
    }

    /**
     * @return mixed
     */
    public function getIdCidade()
    {
        return $this->idCidade;
    }

    /**
     * @param mixed $idCidade
     */
    public function setIdCidade($idCidade): void
    {
        $this->idCidade = $idCidade;
    }

    /**
     * @return mixed
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * @param mixed $rua
     */
    public function setRua($rua): void
    {
        $this->rua = $rua;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro): void
    {
        $this->bairro = $bairro;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep): void
    {
        $this->cep = $cep;
    }

    /**
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param mixed $complemento
     */
    public function setComplemento($complemento): void
    {
        $this->complemento = $complemento;
    }

    /**
     * @return mixed
     */
    public function getisAtivo()
    {
        return $this->isAtivo;
    }

    /**
     * @param mixed $isAtivo
     */
    public function setIsAtivo($isAtivo): void
    {
        $this->isAtivo = $isAtivo;
    }
}