<?php
include_once 'header.php';
include_once '../../model/CategoriasDAO.php';
include_once '../../model/ProdutosBean.php';
include_once '../../model/ProdutosDAO.php';

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
                        $produtoDao = new ProdutosDAO();
                        $categoriaDao = new CategoriasDAO();
                        $produto = $produtoDao->getProdutoPorId($id);
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
                                    $categoriasDAO = new CategoriasDAO();

                                    foreach ($categoriasDAO->getAll() as $categoriaBean) {
                                        if ($categoriaBean instanceof EstadosBean) {

                                            echo "<option value='" . $categoriaBean->getId() . "'>" . $categoriaBean->getNome() . "</option";

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