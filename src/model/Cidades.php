<?php

class Cidades
{
    private $id;
    private $idEstado;
    private $nome;

    /**
     * Cidades constructor.
     * @param $id
     * @param $idEstado
     * @param $nome
     */
    public function __construct($id, $idEstado, $nome)
    {
        $this->id = $id;
        $this->idEstado = $idEstado;
        $this->nome = $nome;
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
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * @param mixed $idEstado
     */
    public function setIdEstado($idEstado): void
    {
        $this->idEstado = $idEstado;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }
}