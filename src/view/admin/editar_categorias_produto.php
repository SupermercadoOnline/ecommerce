<?php
include_once '../../configs.php';
include_once ROOT_PATH . '/controller/CategoriaProdutosController.php';
include_once ROOT_PATH . '/model/CategoriasProdutos.php';
include_once "header.php";

$categoriasController = new CategoriaProdutosController();



if(!empty($_GET["editar"])){
    $id = $_GET["editar"];
    $categoriasBEAN = $categoriasController->getById($id);


}


?>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Edição das categorias</b>
            </h3>
        </div>

        <div class="panel-body">

            <form action="<?php echo URL_HOST ?>/admin/editar_categorias_produto.php" method="post">

                <input type="hidden" name="id" value="<?php echo $categoriasBEAN->getId()?>">


                <div class="row">
                    <div class="col-lg-offset-4 col-lg-4">
                        <label for="nome">Nome:</label>
                        <input id="nome" name="nome" type="text" value="<?php echo $categoriasBEAN->getNome() ?>" class="form-control input-lg">
                    </div>
                </div>

                <div class="row">
                    <br>
                    <input name="alterar" type="submit" value="Alterar" class="btn btn-primary btn-lg center-block">
                </div>

            </form>

        </div>

    </div>

<?php
include_once 'footer.php';
