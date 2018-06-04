<?php
include_once '../../model/CategoriasProdutosDAO.php';
include_once '../../model/CategoriasProdutosBean.php';
include_once 'header.php';

if($_POST["Cadastrar"]){

    $categoriaProdutos = new CategoriasProdutosBean(null, $_POST["nome"], $_POST["isAtivo"]);

    $categoriaProdutosDAO = new CategoriasProdutosDAO();

    if($categoriaProdutosDAO->salvar($categoriaProdutos)){

    

    }



}

include_once 'footer.php';