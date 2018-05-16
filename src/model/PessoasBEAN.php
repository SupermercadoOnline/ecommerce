<?php

class PessoasBEAN
{
    private $id;
    private $nome;
    private $razaoSocial;
    private $cpf;
    private $cnpj;
    private $email;
    private $senha;
    private $isAtivo;
    private $isReceberAlertasPromocao;

    /**
     * PessoasBEAN constructor.
     * @param $id
     * @param $nome
     * @param $razaoSocial
     * @param $cpf
     * @param $cnpj
     * @param $email
     * @param $senha
     * @param $isAtivo
     * @param $isReceberAlertasPromocao
     */
    public function __construct($id, $nome, $razaoSocial, $cpf, $cnpj, $email, $senha, $isAtivo, $isReceberAlertasPromocao)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->razaoSocial = $razaoSocial;
        $this->cpf = $cpf;
        $this->cnpj = $cnpj;
        $this->email = $email;
        $this->senha = $senha;
        $this->isAtivo = $isAtivo;
        $this->isReceberAlertasPromocao = $isReceberAlertasPromocao;
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
    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    /**
     * @param mixed $razaoSocial
     */
    public function setRazaoSocial($razaoSocial): void
    {
        $this->razaoSocial = $razaoSocial;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj): void
    {
        $this->cnpj = $cnpj;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha): void
    {
        $this->senha = $senha;
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

    /**
     * @return mixed
     */
    public function getisReceberAlertasPromocao()
    {
        return $this->isReceberAlertasPromocao;
    }

    /**
     * @param mixed $isReceberAlertasPromocao
     */
    public function setIsReceberAlertasPromocao($isReceberAlertasPromocao): void
    {
        $this->isReceberAlertasPromocao = $isReceberAlertasPromocao;
    }
}