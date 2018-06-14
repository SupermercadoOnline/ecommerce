<?php
include_once "../../configs.php";
include_once ROOT_PATH . '/controller/CategoriaProdutosController.php';
include_once ROOT_PATH . '/model/Produtos.php';
include_once ROOT_PATH . '/controller/ProdutosController.php';
include_once 'header.php';

if($_GET["ativar"]){
    $id = $_GET["ativar"];
    $produtoDao = new ProdutosController();
    $produto = $produtoDao->getById($id);

    if($produto instanceof Produtos){
        if($produtoDao->ativar($produto)){
            ?>

            <div class="panel-body">
                <div class="row">
                    <div class="alert alert-success col-lg-12">
                        Produto ativado com sucesso!
                        <button class="close" data-dismiss="alert">X</button>
                    </div>
                </div>
            </div>

            <?php
        } else {
            ?>

            <div class="panel-body">
                <div class="row">
                    <div class="alert alert-danger col-lg-12">
                        Não foi possível ativar o produto!
                        <button class="close" data-dismiss="alert">X</button>
                    </div>
                </div>
            </div>

            <?php
        }
    }
}

?>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Lista de produtos</b>
            </h3>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12">
                    <label for="exibir">Exibir cadastros</label>
                    <a class="btn btn-primary" href="visualizar_produto.php">Ativos </a>

                    <div class="table-responsive">
                        <br>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Categoria</th>
                                <th>Status</th>
                                <th>Opções</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $produtosDao = new ProdutosController();
                            $categoriasDao = new CategoriaProdutosController();

                            foreach ($produtosDao->retornePorStatus(false) as $produtoBean) {
                                $categoriaBean = $categoriasDao->getById($produtoBean->getIdCategoria());
                                if ($produtoBean instanceof Produtos && $categoriaBean instanceof CategoriaProdutos) {

                                    if($produtoBean->getIsAtivo()){
                                        $status = "Ativo";

                                    } else {
                                        $status = "Inativo";
                                    }

                            ?>
                            <tr>
                                <td><?php echo $produtoBean->getNome() ?> </td>
                                <td><?php echo $produtoBean->getPreco() ?> </td>
                                <td><?php echo $categoriaBean->getNome() ?> </td>
                                <td><?php echo $status ?> </td>
                                <td>
                                    <a class="btn btn-primary" href="visualizar_produtos_inativos.php?ativar=<?php echo $produtoBean->getId() ?>">Ativar</a>
                                </td>
                            </tr>

                            <?php
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include_once 'footer.php';
