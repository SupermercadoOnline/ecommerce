<?php
include_once '../../controller/CategoriasProdutosController.php';

if($_POST["alterar"]) {
    $categoriasController =  new CategoriasProdutosController();
    $categorias = new CategoriasProdutos($_POST["id"], $_POST["nome"], true);

    if ($categoriasController->salvar($categorias)) {

        header("location: /admin/visualizar_categorias_produto.php?retorno_edicao=1");

    } else {

        header("location: /admin/visualizar_categorias_produto.php?retorno_edicao=0");

    }


}