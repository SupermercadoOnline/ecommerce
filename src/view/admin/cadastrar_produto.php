<?php
include_once 'header.php';
include_once '../../model/CategoriasProdutosDAO.php';
include_once '../../model/ProdutosBean.php';
include_once '../../model/ProdutosDAO.php';

if($_POST["cadastrar"]){
    $produto = new ProdutosBean(null, $_POST["nome"], $_POST["categoria"], $_POST["preco"],
    $_POST["fabricante"], $_POST["descricao"], $_POST["estoque_minimo"], null);

    $produtoDao = new ProdutosDAO();

    if($produtoDao->salvar($produto)){
        ?>

        <div class="panel-body">
            <div class="row">
                <div class="alert alert-success col-lg-4">
                    Produto cadastrado com sucesso!
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
                    Não foi possível cadastrar este produto!
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
            <b>Novo produto</b>
        </h3>
    </div>

    <div class="panel-body">

        <form action="<?php echo URL_HOST ?>/cadastrar_produto.php" method="post">

            <div class="row">

                <div class="col-lg-4">
                    <label for="nome">Nome:</label>
                    <input id="nome" name="nome" type="text" class="form-control input-lg">
                </div>

                <div class="col-lg-2">
                    <label for="preco">Preço</label>
                    <input id="preco" name="preco" type="text" class="form-control input-lg">
                </div>

                <div class="col-lg-3">

                    <label for="categoria">Categoria</label>

                    <select name="categoria" class="form-control input-lg">
                        <?php
                        $categoriasDAO = new CategoriasProdutosDAO();

                        foreach ($categoriasDAO->getAll() as $categoriaBean){
                            if($categoriaBean instanceof CategoriasProdutosBean){

                                echo "<option value='".$categoriaBean->getId()."'>".$categoriaBean->getNome()."</option";

                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-lg-3">
                    <label for="fabricante">Fabricante</label>
                    <input id="fabricante" name="fabricante" type="text" class="form-control input-lg">
                </div>
                <!--continuar com os outros atributos-->

            </div>

            <div class="row">
                <br/>
                <div class="col-lg-4">
                    <label for="descricao">Descrição</label>
                    <input id="descricao" name="fabricante" type="text" class="form-control input-lg">
                </div>

                <div class="col-lg-2">
                    <label for="estoque_minimo">Estoque Minimo</label>
                    <input id="estoque_minimo" name="estoque_minimo" type="text" class="form-control input-lg">
                </div>
            </div>

            <div class="row">
                <br/>
                <div class="col-lg-3">
                    <input name="cadastrar" type="submit" value="Cadastrar" class="form-control input-lg">
                </div>

            </div>

        </form>

    </div>

</div>

<?php
include_once 'footer.php';
