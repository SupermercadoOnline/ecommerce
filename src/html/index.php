<?php
include_once '../model/EstadosDAO.php';
?>

<html lang="pt-br">

<?php
include_once '../view/head_section.php';
?>

<div class="container">

    <div class="row">

        <div class="col-xl-12 col-lg-12">

            <h1 class="text-center">
                Modelo
            </h1>

        </div>

    </div>

    <div class="row">

        <div class="col-xl-12 col-lg-12">

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
                    $estadosDAO = new EstadosDAO();
                    foreach ($estadosDAO->getAll() as $estadoBean){
                        if($estadoBean instanceof EstadosBean){
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
include_once '../view/js_section.php';
?>

</html>