<?php


class Estados
{

    private $id;
    private $nome;
    private $sigla;

    /**
     * Estados constructor.
     * @param $id
     * @param $nome
     * @param $sigla
     */
    public function __construct($id, $nome, $sigla)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->sigla = $sigla;
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

    /**
     * @return mixed
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * @param mixed $sigla
     */
    public function setSigla($sigla): void
    {
        $this->sigla = $sigla;
    }

}