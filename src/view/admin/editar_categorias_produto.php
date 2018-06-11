<?php
include_once "header.php";
include_once ROOT_PATH . '/controller/CategoriasProdutosController.php';
include_once ROOT_PATH . '/model/CategoriasProdutos.php';

if($_POST["alterar"]){
    $categorias = new CategoriasProdutos($_POST["id"], $_POST["nome"],  true);

    $categoriasController = new CategoriasProdutosController();

    if($categoriasController->salvar($categorias)){
        ?>

        <div class="panel-body">
            <div class="row">
                <div class="alert alert-success col-lg-4">
                    Categoria alterada com sucesso!
                    <button class="close" data-dismiss="alert">X</button>
                </div>
            </div>
        </div>

        <?php
    } else {
        ?>

        <div class="panel-body">
            <div class="row">
                <div class="alert alert-danger col-lg-4">
                    Não foi possível alterar esta categoria!
                    <button class="close" data-dismiss="alert">X</button>
                </div>
            </div>
        </div>

        <?php
    }
}