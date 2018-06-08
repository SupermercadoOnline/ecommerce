<?php
include_once '../view/header_html_section.php';

include_once ROOT_PATH . '/controller/EstadosController.php';
?>

<div class="container">

    <div class="row">

        <div class="col-lg-12">

            <h1 class="text-center">
                Modelo
            </h1>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-12">

            <div class="table-responsive">

                <table class="table table-bordered table-hover table-striped">

                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Sigla</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    $estadosDAO = new EstadosController();
                    foreach ($estadosDAO->getAll() as $estadoBean){
                        if($estadoBean instanceof Estados){
                            ?>

                            <tr>
                                <td><?php echo $estadoBean->getId() ?></td>
                                <td><?php echo $estadoBean->getNome() ?></td>
                                <td><?php echo $estadoBean->getSigla() ?></td>
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

<?php
include_once '../view/footer_html_section.php';