<?php
include_once "../../configs.php";
include_once ROOT_PATH."/controller/PessoasController.php";
include_once 'header.php';
?>
    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Clientes cadastrados</b>
            </h3>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12">

                    <div class="table-responsive">
                        <br>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Razão social</th>
                                <th>CPF/CPNJ</th>
                               <th>Alerta de promoção</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $pessoasController = new PessoasController();


                            foreach ($pessoasController->getByTipo(2) as $pessoas) {

                                if ($pessoas instanceof Pessoas) {
                                    if($pessoas->getIsAtivo()){
                                        $alertas = "Ativo";

                                    } else {
                                        $alertas = "Inativo";
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $pessoas->getNome() ?> </td>
                                        <td><?php echo empty($pessoas->getRazaoSocial()) ? '  -  ' :$pessoas->getRazaoSocial() ?> </td>
                                        <td><?php echo empty($pessoas->getCpf()) ? $pessoas->getCnpj() : $pessoas->getCpf() ?> </td>

                                        <td><?php echo $alertas ?> </td>

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


