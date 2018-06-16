<?php
include_once '../../configs.php';
include_once ROOT_PATH . '/controller/CategoriaProdutosController.php';
include_once ROOT_PATH . '/model/Produtos.php';
include_once ROOT_PATH . '/controller/ProdutosController.php';
include_once 'header.php';

?>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Edição do produto</b>
            </h3>
        </div>

        <div class="panel-body">

            <form action="<?php echo URL_HOST ?>/admin/editar_produto.php" method="post">

                <?php
                    if($_GET["editar"]) {
                            $id = $_GET["editar"];
                            $produtoController = new ProdutosController();
                            $categoriaController = new CategoriaProdutosController();
                            $produto = $produtoController->getById($id);
                            $categorias = $categoriaController->getAll();


                        ?>

                        <div class="row">

                            <div class="col-lg-4">
                                <label for="nome">Nome:</label>
                                <input id="nome" name="nome" type="text" value="<?php echo $produto->getNome() ?>" class="form-control input-lg">
                            </div>

                            <div class="col-lg-2">
                                <label for="preco">Preço</label>
                                <input id="preco" name="preco" type="text" value="<?php echo $produto->getPreco() ?>" class="form-control input-lg mascara-reais">
                            </div>

                            <div class="col-lg-3">

                                <label for="categoria">Categoria</label>

                                <div class="form-group-lg">
                                    <select name="categoria" class="form-control selectpicker">
                                        <?php
                                        $categoriasController = new CategoriaProdutosController();

                                        foreach ($categoriasController->retornePorStatus(true) as $categoriaBean) {
                                            if ($categoriaBean instanceof CategoriaProdutos) {

                                                $selected = ($produto->getIdCategoria() == $categoriaBean->getId()) ? 'selected' : null;
                                                ?>
                                                <option value='<?php echo $categoriaBean->getId() ?>' <?php echo $selected ?> >
                                                    <?php echo $categoriaBean->getNome()?>
                                                </option>

                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <br/>

                            <div class="col-lg-3">
                                <label for="fabricante">Fabricante</label>
                                <input id="fabricante" name="fabricante" type="text" value="<?php echo $produto->getFabricante() ?>" class="form-control input-lg">
                            </div>

                            <div class="col-lg-4">
                                <label for="descricao">Descrição</label>
                                <input id="descricao" name="descricao" type="text" value="<?php echo $produto->getDescricao() ?>" class="form-control input-lg">
                            </div>

                            <div class="col-lg-2">
                                <label for="estoque_minimo">Estoque Minimo</label>
                                <input id="estoque_minimo" name="estoque_minimo" value="<?php echo $produto->getEstoqueMinimo() ?>" type="text"
                                       class="form-control input-lg">
                            </div>

                            <input id="id" name="id" type="hidden" value="<?php echo $produto->getId() ?>">
                        </div>

                        <?php
                    }
                        ?>

                <div class="row">
                    <br/>
                    <div class="col-lg-3">
                        <input name="alterar" type="submit" value="Alterar" class="btn btn-primary col-lg-4">
                    </div>

                </div>

            </form>

        </div>

    </div>

<?php
include_once 'footer.php';