<?php
include_once 'header.php';
include_once ROOT_PATH . '/controller/PessoasController.php';
include_once ROOT_PATH . '/controller/VendasController.php';
include_once ROOT_PATH . '/model/Pessoas.php';

$pessoaController = new PessoasController();
$vendasController = new VendasController();
$id = $_SESSION['login']['id_pessoa'];

$pessoa = $pessoaController->getById($id);
$listaVendas = $vendasController->retornePorPessoa($pessoa->getId());

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
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Categoria</th>
                                <th>Status</th>
                                <th>Opções</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include_once 'footer.php';
