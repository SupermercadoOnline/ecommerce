<?php
include_once "header.php";

include_once ROOT_PATH . "/model/CategoriasProdutos.php";
include_once ROOT_PATH . "/controller/CategoriasProdutosController.php";

if($_GET["desativar"]){
    $id = $_GET["desativar"];
    $categoriaDAO = new CategoriasProdutosController();
    $categoria = $categoriaDAO->getById($id);

    if($categoria instanceof CategoriasProdutos){
        if($categoriaDAO->delete($categoria)){
            ?>

            <div class="panel-body">
                <div class="row">
                    <div class="alert alert-success col-lg-4">
                        Categoria inativado com sucesso!
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
                        Não foi possível inativar a categoria!
                        <button class="close" data-dismiss="alert">X</button>
                    </div>
                </div>
            </div>

            <?php
        }
    }
}