<?php
include_once 'header.php';
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

                <div class="col-lg-4">

                    <label for="preco">Preço</label>
                    <input id="preco" name="preco" type="text" class="form-control input-lg">

                </div>

                <!--continuar com os outros atributos-->

            </div>

        </form>

    </div>

</div>

<?php
include_once 'footer.php';
