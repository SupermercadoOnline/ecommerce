<?php
include_once '../../controller/CategoriaProdutosController.php';

if($_POST["alterar"]) {
    $categoriasController =  new CategoriaProdutosController();
    $categorias = new CategoriaProdutos($_POST["id"], $_POST["nome"], true);

    if ($categoriasController->salvar($categorias)) {

        header("location: /admin/visualizar_categoria_produtos.php?retorno_edicao=1");

    } else {

        header("location: /admin/visualizar_categoria_produtos.php?retorno_edicao=0");

    }


}