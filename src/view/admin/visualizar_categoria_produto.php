<?php
include_once "header.php";

include_once ROOT_PATH . "/model/CategoriaProdutos.php";
include_once ROOT_PATH . "/controller/CategoriaProdutosController.php";


if(isset($_GET["retorno_edicao"])) {
    if (empty($_GET["retorno_edicao"])) {
        ?>
        <div class="row">
            <div class="alert alert-success">
                Não foi possivel alterar esta categoria!
                <button class="close" data-dismiss="alert">X</button>
            </div>
        </div>

        <?php
    } else {
        ?>

        <div class="row">
            <div class="alert alert-success">
                Categoria alterada com sucesso!
                <button class="close" data-dismiss="alert">X</button>
            </div>
        </div>

        <?php

    }
}


    if (!empty($_GET["desativar"])) {
        $id = $_GET["desativar"];
        $categoriasController = new CategoriaProdutosController();
        $categoria = $categoriasController->getById($id);

        if ($categoria instanceof CategoriaProdutos) {
            if ($categoriasController->delete($categoria)) {
                ?>

                <div class="panel-body">
                    <div class="row">
                        <div class="alert alert-success col-lg-4">
                            Categoria inativado com sucesso!
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
                            Não foi possível inativar a categoria!
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
                    <a href="<?php echo URL_HOST?>/admin/visualizar_categoria_produtos_inativos.php">Inativos</a>

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

                            $categoriasController = new CategoriaProdutosController();

                            foreach ($categoriasController->retornePorStatus(true) as $categoriasBean) {

                                if ($categoriasBean instanceof CategoriaProdutos) {

                                    if($categoriasBean->getIsAtivo()){
                                        $status = "Ativo";

                                    } else {
                                        $status = "Inativo";
                                    }

                                    ?>
                                    <tr>
                                        <td><?php echo $categoriasBean->getNome() ?> </td>
                                        <td><?php echo $status ?> </td>
                                        <td>
                                            <a  class="btn btn-danger" href="/admin/visualizar_categoria_produtos.php?desativar=<?php echo $categoriasBean->getId() ?>">Desativar</a>
                                            <a  class ="btn btn-primary" href="/admin/form_editar_categorias_produto.php?editar=<?php echo $categoriasBean->getId() ?>">Editar</a>
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