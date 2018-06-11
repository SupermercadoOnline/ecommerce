<?php
include_once 'header.php';
include_once ROOT_PATH . '/controller/CategoriasProdutosController.php';
include_once ROOT_PATH . '/model/Produtos.php';
include_once ROOT_PATH . '/controller/ProdutosController.php';

if($_POST["alterar"]){
    $produto = new Produtos($_POST["id"], $_POST["nome"], $_POST["categoria"], $_POST["preco"],
        $_POST["fabricante"], $_POST["descricao"], $_POST["estoque_minimo"], true);

    $produtoDao = new ProdutosController();

    if($produtoDao->salvar($produto)){
        ?>

        <div class="panel-body">
            <div class="row">
                <div class="alert alert-success col-lg-4">
                    Produto alterado com sucesso!
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
                    Não foi possível alterar este produto!
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
                <b>Edição do produto</b>
            </h3>
        </div>

        <div class="panel-body">

            <form action="<?php echo URL_HOST ?>/editar_produto.php" method="post">

                <?php
                    if($_GET["editar"]) {
                        $id = $_GET["editar"];
                        $produtoDao = new ProdutosController();
                        $categoriaDao = new CategoriasProdutosController();
                        $produto = $produtoDao->getById($id);
                        $categorias = $categoriaDao->getAll();


                        ?>

                        <div class="row">

                            <div class="col-lg-4">
                                <label for="nome">Nome:</label>
                                <input id="nome" name="nome" type="text" value="<?php $produto->getNome() ?>" class="form-control input-lg">
                            </div>

                            <div class="col-lg-2">
                                <label for="preco">Preço</label>
                                <input id="preco" name="preco" type="text" value="<?php $produto->getPreco() ?>" class="form-control input-lg">
                            </div>

                            <div class="col-lg-3">

                                <label for="categoria">Categoria</label>

                                <select name="categoria" class="form-control input-lg">
                                    <?php
                                    $categoriasDAO = new CategoriasProdutosController();

                                    foreach ($categoriasDAO->getAll() as $categoriaBean) {
                                        if ($categoriaBean instanceof CategoriasProdutos) {

                                            $selected = $produto->getIdCategoria() == $categoriaBean->getId() ? 'selected' : null;
                                            echo "<option value='".$categoriaBean->getId()."'>".$categoriaBean->getNome()."</option";

                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <label for="fabricante">Fabricante</label>
                                <input id="fabricante" name="fabricante" type="text" value="<?php $produto->getFabricante() ?>" class="form-control input-lg">
                            </div>

                        </div>

                        <div class="row">
                            <br/>
                            <div class="col-lg-4">
                                <label for="descricao">Descrição</label>
                                <input id="descricao" name="fabricante" type="text" value="<?php $produto->getDescricao() ?>" class="form-control input-lg">
                            </div>

                            <div class="col-lg-2">
                                <label for="estoque_minimo">Estoque Minimo</label>
                                <input id="estoque_minimo" name="estoque_minimo" value="<?php $produto->getEstoqueMinimo() ?>" type="text"
                                       class="form-control input-lg">
                            </div>

                            <input id="id" name="id" type="hidden" value="<?php $produto->getId() ?>">
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