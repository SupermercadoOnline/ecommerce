<?php

class Telefones
{
    private $id;
    private $idPessoa;
    private $numeroTelefone;
    private $isAtivo;

    /**
     * Telefones constructor.
     * @param $id
     * @param $idPessoa
     * @param $numeroTelefone
     * @param $isAtivo
     */
    public function __construct($id, $idPessoa, $numeroTelefone, $isAtivo)
    {
        $this->id = $id;
        $this->idPessoa = $idPessoa;
        $this->numeroTelefone = $numeroTelefone;
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
    public function getNumeroTelefone()
    {
        return $this->numeroTelefone;
    }

    /**
     * @param mixed $numeroTelefone
     */
    public function setNumeroTelefone($numeroTelefone): void
    {
        $this->numeroTelefone = $numeroTelefone;
    }

    /**
     * @return mixed
     */
    public function getIsAtivo()
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