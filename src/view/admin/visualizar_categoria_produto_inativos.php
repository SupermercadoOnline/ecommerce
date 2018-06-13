<?php
include_once "../../configs.php";
include_once ROOT_PATH . '/controller/CategoriaProdutosController.php';
include_once ROOT_PATH . '/model/CategoriaProdutos.php';
include_once 'header.php';

$categoriasController = new CategoriaProdutosController();
if($_GET["ativar"]){
    $id = $_GET["ativar"];

    $categorias = $categoriasController->getById($id);

    if($categorias instanceof CategoriaProdutos){
        if($categoriasController->ativar($categorias)){
            ?>

            <div class="panel-body">
                <div class="row">
                    <div class="alert alert-success col-lg-4">
                        Categoria ativada com sucesso!
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
                        Não foi possivel ativar essa categoria!
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
                <b>Lista de categorias</b>
            </h3>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12">
                    <label for="exibir">Exibir cadastros: </label>
                    <a href="<?php echo URL_HOST?>/admin/visualizar_categorias_produtos.php">Ativos </a>

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Status</th>
                                <th>Opções</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php


                            foreach ($categoriasController->retornePorStatus(false) as $categorias) {

                                if ($categorias instanceof CategoriaProdutos) {

                                    if($categorias->getIsAtivo()){
                                        $status = "Ativo";

                                    } else {
                                        $status = "Inativo";
                                    }

                                    ?>
                                    <tr>
                                        <td><?php echo $categorias->getNome() ?> </td>
                                        <td><?php echo $status ?> </td>
                                        <td>
                                            <a href="visualizar_produtos_inativos.php?ativar=<?php $categorias->getId() ?>">Ativar</a>
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
