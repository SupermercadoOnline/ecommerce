<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 17/05/2018
 * Time: 10:51
 */

class CategoriasProdutosBean
{
    private $id;
    private $nome;
    private $isAtivo;

    public function __construct($id, $nome, $isAtivo)
    {
        $this->id = $id;
        $this->nome = $nome;
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

    public function getIsAtivo()
    {
        return $this->isAtivo;
    }

    /**
     * @param $isAtivo
     */
    public function setIsAtivo($isAtivo): void
    {

        $this->$isAtivo = $isAtivo;

    }

}