<?php
include_once 'header.php';
include_once ROOT_PATH . '/controller/CategoriaProdutosController.php';
include_once ROOT_PATH . '/model/Produtos.php';
include_once ROOT_PATH . '/controller/ProdutosController.php';
include_once ROOT_PATH . '/controller/EstoqueProdutosController.php';

if(!empty($_POST["cadastrar"])){
    $produto = new Produtos(null, $_POST["nome"], $_POST["categoria"], remover_mascara_reais($_POST["preco"]),
    $_POST["fabricante"], $_POST["descricao"], $_POST["estoque_minimo"], null);

    $produtoController = new ProdutosController();

    $produto = $produtoController->salvar($produto);
    if($produto){
        $estoqueProdutosController = new EstoqueProdutosController();
        $estoqueProdutosController->entradaProduto($produto, $_POST['estoque_inicial']);
        ?>

        <div class="row">
            <div class="container">
                <div class="alert alert-success">
                    Produto cadastrado com sucesso!
                    <button class="close" data-dismiss="alert">&times;</button>
                </div>
            </div>
        </div>

        <?php
    } else {
        ?>

        <div class="row">
            <div class="container">
                <div class="alert alert-danger">
                    Não foi possível cadastrar este produto!
                    <button class="close" data-dismiss="alert">&times;</button>
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
            <b>Novo produto</b>
        </h3>
    </div>

    <div class="panel-body">

        <form action="<?php echo URL_HOST ?>/admin/form_cadastrar_produto.php" method="post">

            <div class="row">

                <div class="col-lg-4">
                    <label for="nome">Nome:</label>
                    <input required id="nome" name="nome" type="text" class="form-control input-lg">
                </div>

                <div class="col-lg-2">
                    <label for="preco">Preço</label>
                    <input required id="preco" name="preco" type="text" class="form-control input-lg mascara-reais">
                </div>

                <div class="col-lg-3">

                    <label for="categoria">Categoria</label>

                    <div class="form-group-lg">
                        <select required name="categoria" class="form-control selectpicker" title="Selecione">
                            <?php
                            $categoriasController = new CategoriaProdutosController();

                            foreach ($categoriasController->retornePorStatus(true) as $categoriaBean){
                                if($categoriaBean instanceof CategoriaProdutos){
                                    ?>

                                    <option value='<?php echo $categoriaBean->getId() ?>'>
                                        <?php echo $categoriaBean->getNome()?>
                                    </option>

                                    <?php

                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3">
                    <label for="fabricante">Fabricante</label>
                    <input required id="fabricante" name="fabricante" type="text" class="form-control input-lg">
                </div>

            </div>

            <div class="row">
                <br/>
                <div class="col-lg-4">
                    <label for="descricao">Descrição</label>
                    <input required id="descricao" name="descricao" type="text" class="form-control input-lg">
                </div>

                <div class="col-lg-2">
                    <label for="estoque-inicial">Estoque inicial:</label>
                    <input required id="estoque-inicial" name="estoque_inicial" min="1" type="number" class="form-control input-lg">
                </div>

                <div class="col-lg-2">
                    <label for="estoque_minimo">Estoque Minimo</label>
                    <input required id="estoque_minimo" name="estoque_minimo" type="text" class="form-control input-lg">
                </div>
            </div>

            <div class="row">
                <br/>
                <input name="cadastrar" type="submit" value="Cadastrar" class="btn btn-primary btn-lg center-block">
            </div>

        </form>

    </div>

</div>

<?php
include_once 'footer.php';
