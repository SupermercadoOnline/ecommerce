<?php
include_once 'header.php';
include_once ROOT_PATH . '/controller/PessoasController.php';
include_once ROOT_PATH . '/controller/VendasController.php';
include_once ROOT_PATH . '/controller/ProdutosVendaController.php';
include_once ROOT_PATH . '/controller/ProdutosController.php';
include_once ROOT_PATH . '/model/Pessoas.php';
include_once ROOT_PATH . '/model/ProdutosVenda.php';
include_once ROOT_PATH . '/model/Produtos.php';
include_once ROOT_PATH . '/model/Vendas.php';

$pessoaController = new PessoasController();
$vendasController = new VendasController();
$id = $_SESSION['login']['id_pessoa'];

$pessoa = $pessoaController->getById($id);
$produtoController = new ProdutosController();
$produtosVendaController = new ProdutosVendaController();



?>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Suas compras</b>
            </h3>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12">
                    <label for="exibir">Compras</label>

                    <div class="table-responsive">
                        <br>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Data da Compra</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            foreach ($vendasController->retornePorPessoa($pessoa->getId()) as $venda){
                                if($venda instanceof Vendas){
                                    foreach ($produtosVendaController->getByIdVenda($venda->getId()) as $produto_venda){
                                        $idProduto = $produtosVendaController->getByIdProduto($produto_venda->getIdProduto());
                                        $produto = $produtoController->getById($idProduto);
                                        if($produto instanceof Produtos){
                                            ?>
                                            <tr>
                                                <td><?php echo $produto->getNome()?></td>
                                                <td><?php echo aplicar_mascara_reais($produto->getPreco())?></td>
                                                <td><?php echo $venda->getDataVenda()?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
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
