<?php
include_once "header.php";
include_once ROOT_PATH . '/controller/CategoriasProdutosController.php';
include_once ROOT_PATH . '/model/CategoriasProdutos.php';

if($_POST["alterar"]) {
    $categorias = new CategoriasProdutos($_POST["id"], $_POST["nome"], true);

    $categoriasController = new CategoriasProdutosController();

    if ($categoriasController->salvar($categorias)) {
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
?>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Edição das categorias</b>
            </h3>
        </div>

        <div class="panel-body">

            <form action="<?php echo URL_HOST ?>/editar_categorias_produto.php" method="post">

                <?php
                if($_GET["editar"]) {
                    $id = $_GET["editar"];
                    $categoriasController = new CategoriasProdutosController();
                    $categorias = $categoriasController->getAll($id);


                    ?>

                    <div class="row">

                        <div class="col-lg-4">
                            <label for="nome">Nome:</label>
                            <input id="nome" name="nome" type="text" value="<?php $categorias->getNome() ?>" class="form-control input-lg">
                        </div>


                    </div>


                    <?php
                }
                ?>

                <div class="row">
                    <br/>
                    <div class="col-lg-3">
                        <input name="alterar" type="submit" value="Alterar" class="form-control input-lg">
                    </div>

                </div>

            </form>

        </div>

    </div>

<?php
include_once 'footer.php';
