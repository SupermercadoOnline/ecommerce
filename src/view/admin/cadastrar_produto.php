<?php
include_once 'header.php';
include_once "../../model/CategoriasDAO.php";
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
                        $categoriasDAO = new CategoriasDAO();

                        foreach ($categoriasDAO->getAll() as $categoriaBean){
                            if($categoriaBean instanceof EstadosBean){

                                echo "<option value='".$categoriaBean->getId()."'>".$categoriaBean->getNome()."</option";

                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-lg-2">

                    <label for="fabricante">Fabricante</label>
                    <input id="fabricante" name="fabricante" type="text" class="form-control input-lg">

                </div>
                <!--continuar com os outros atributos-->

            </div>

        </form>

    </div>

</div>

<?php
include_once 'footer.php';
