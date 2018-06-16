<?php
include_once '../../controller/ProdutosController.php';
include_once '../../functions.php';

if($_POST["alterar"]) {
    $produto = new Produtos($_POST["id"], $_POST["nome"], $_POST["categoria"], remover_mascara_reais($_POST["preco"]),
        $_POST["fabricante"], $_POST["descricao"], $_POST["estoque_minimo"], true);

    $produtoController = new ProdutosController();

    if ($produtoController->salvar($produto)) {

        header("location: /admin/visualizar_produto.php?retorno_edicao=1");

    } else {

        header("location: /admin/visualizar_produto.php?retorno_edicao=0");

    }


}