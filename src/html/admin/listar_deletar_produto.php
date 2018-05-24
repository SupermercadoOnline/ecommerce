<?php
include_once 'header.php';
include_once '../../model/CategoriasDAO.php';
include_once '../../model/ProdutosBean.php';
include_once '../../model/ProdutosDAO.php';

?>

    <div class="panel panel-primary">

        <div class="panel-heading">

            <h3 class="panel-title">
                <b>Lista de produtos</b>
            </h3>

            <div class="panel-body">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="table-responsive">

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
                                $produtosDao = new ProdutosDAO();
                                $categoriasDao = new CategoriasDAO();

                                foreach ($produtosDao->getAll() as $produtoBean) {
                                    $categoriaBean = $categoriasDao->getCategoriaPorId($produtoBean->getIdCatergoria());
                                    if ($produtoBean instanceof ProdutosBean && $categoriaBean instanceof CategoriasBean) {

                                        if($produtoBean->getIsAtivo()){
                                            $status = "Ativo";

                                        } else {
                                            $status = "Inativo";
                                        }

                                        ?>
                                        <tr>
                                            <td><?php echo $produtoBean->getNome() ?></td>
                                            <td><?php echo $produtoBean->getPreco() ?></td>
                                            <td><?php echo $categoriaBean->getNome() ?></td>
                                            <td><?php echo $status ?></td>
                                            <td> <input type="button" name="desativar" value="Desativar"></td>
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
    </div>


<?php
include_once 'footer.php';
