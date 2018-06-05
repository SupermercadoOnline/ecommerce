<?php
include_once "../../model/CategoriasProdutosBean.php";
include_once "../../model/CategoriasProdutosDAO.php";
include_once "header.php";

if($_GET["desativar"]){
    $id = $_GET["desativar"];
    $categoriaDAO = new CategoriasProdutosDAO();
    $categoria = $categoriaDAO->getProdutoPorId($id);





}