<?php

class Produtos{

	private $id;
	private $nome;
	private $idCatergoria;
	private $preco;
	private $fabricante;
	private $descricao;
	private $estoqueMinimo;
	private $isAtivo;
	
	public function __construct($id, $nome, $idCatergoria, $preco, $fabricante, $descricao, $estoqueMinimo, $isAtivo){
		$this->id = $id;
		$this->nome = $nome;
		$this->idCatergoria = $idCatergoria;
		$this->preco = $preco;
		$this->fabricante = $fabricante;
		$this->descricao = $descricao;
		$this->estoqueMinimo = $estoqueMinimo;
		$this->isAtivo = $isAtivo;
	}
	
	public function setId($id): void{
		$this->id= $id;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setNome($nome): void{
		$this->nome = $nome;
	}
	
	public function getNome(){
		return $this->nome;
	}

	public function setIdCategoria($idCategoria): void{
	    $this->idCatergoria = $idCategoria;
    }

    public function getIdCatergoria(){
        return $this->idCatergoria;
    }

    public function setPreco($preco){
        $this->preco = $preco;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function setFabricante($fabricante){
        $this->fabricante = $fabricante;
    }

    public function getFabricante(){
        return $this->fabricante;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getEstoqueMinimo()
    {
        return $this->estoqueMinimo;
    }

    public function setEstoqueMinimo($estoqueMinimo): void
    {
        $this->estoqueMinimo = $estoqueMinimo;
    }

    public function setIsAtivo($isAtivo){
        $this->isAtivo = $isAtivo;
    }

    public function getIsAtivo(){
        return $this->isAtivo;
    }
}