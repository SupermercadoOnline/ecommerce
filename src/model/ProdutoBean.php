<?php

class ProdutoBean{
	//duvida estilo da variavel camelcase
	private $id;
	private $nome;
	private $id_catergoria;
	private $preco;
	private $fabricante;
	private $descricao;
	private $is_ativo;
	
	public function __construct($id, $nome, $id_catergoria, $preco, $fabricante, $descricao, $is_ativo){
		$this->id = $id;
		$this->nome = $nome;
		$this->id_catergoria = $id_catergoria;
		$this->preco = $preco;
		$this->fabricante = $fabricante;
		$this->descricao = $descricao;
		$this->is_ativo = $is_ativo;
	}

	/*
	public function __construct($nome, $id_catergoria, $preco, $fabricante, $descricao, $is_ativo){
		$this->nome = $nome;
		$this->id_catergoria = $id_catergoria;
		$this->preco = $preco;
		$this->fabricante = $fabricante;
		$this->descricao = $descricao;
		this->is_ativo = $is_ativo;
	}*/
	
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

	public function setIdCategoria($id_categoria): void{
	    $this->id_categoria = $id_categoria;
    }

    public function getIdCatergoria(){
        return $this->id_catergoria;
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

    public function setIsAtivo($is_ativo){
        $this->is_ativo = $is_ativo;
    }

    public function getIsAtivo(){
        return $this->is_ativo;
    }
}