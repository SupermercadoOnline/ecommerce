<?php
include_once "header.php";

include_once ROOT_PATH . "/model/CategoriasProdutos.php";
include_once ROOT_PATH . "/controller/CategoriasProdutosController.php";

if($_GET["desativar"]){
    $id = $_GET["desativar"];
    $categoriaDAO = new CategoriasProdutosController();
    $categoria = $categoriaDAO->getById($id);

    if($categoria instanceof CategoriasProdutos){
        if($categoriaDAO->delete($categoria)){
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
                    <label for="exibir">Exibir cadastros</label>
                    <a href="não clique">Inativos</a>

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

                            $categoriasController = new CategoriasProdutosController();

                            foreach ($categoriasController->retornePorStatus(true) as $categoriasBean) {

                                if ($categoriasBean instanceof CategoriasProdutos) {

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
                                            <a href="visualizar_categorias_produto.php?desativar=<?php $categoriasBean->getId() ?>">Desativar</a>
                                            <a href="/admin/form_editar_categorias_produto.php?editar=<?php $categoriasBean->getId() ?>">Editar</a>
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