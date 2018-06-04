<?php
include_once '../../model/CategoriasProdutosDAO.php';
include_once '../../model/CategoriasProdutosBean.php';
include_once 'header.php';

if($_POST["Cadastrar"]){

    $categoriaProdutos = new CategoriasProdutosBean(null, $_POST["nome"], $_POST["isAtivo"]);

    $categoriaProdutosDAO = new CategoriasProdutosDAO();

    if($categoriaProdutosDAO->salvar($categoriaProdutos)){
        ?>
        <div class="row">
            <div class="alert alert-success">
                Cadastrado com sucesso!
            </div>
        </div>

        <?php
    }
    else {
        ?>
        <div class="row">
            <div class="alert alert-danger">
                Erro ao cadastrar essa categoria!
            </div>
        </div>
        <?php


    }



}

?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Nova categoria</b>
            </h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo URL_HOST ?>/admin/cadastrar_categoria_produto.php" method="post"></form>
            <div class="row">
                <div class="col-lg-4">
                    <label for="nome">Nome:</label>
                    <input id="nome" name="nome" type="text" class="form-control input-lg">
                </div>



            </div>









        </div>
    </div>


<?php
include_once 'footer.php';