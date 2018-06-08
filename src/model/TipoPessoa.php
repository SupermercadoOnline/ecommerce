<?php

class TipoPessoa
{
    private $id;
    private $nome;

    /**
     * TipoPessoa constructor.
     * @param $id
     * @param $nome
     */
    public function __construct($id, $nome)
    {
        $this->id = $id;
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