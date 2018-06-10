<?php
session_start();
include_once '../../functions.php';

if(possuiPermissao($_SESSION['login']['id_pessoa'], 18)) {

    include_once 'header.php';
    include_once ROOT_PATH . '/controller/PessoasController.php';
    include_once ROOT_PATH . '/controller/TipoPessoaController.php';
    include_once ROOT_PATH . '/controller/TelefonesController.php';
    include_once ROOT_PATH . '/controller/EnderecosController.php';
    include_once ROOT_PATH . '/controller/CidadesController.php';
    include_once ROOT_PATH . '/controller/EstadosController.php';
    include_once ROOT_PATH . '/controller/PermissoesUsuarioController.php';

    $pessoasController = new PessoasController();
    $tipoPessoaController = new TipoPessoaController();
    $telefonesController = new TelefonesController();
    $enderecosController = new EnderecosController();
    $cidadesController = new CidadesController();
    $estadosController = new EstadosController();
    $permissoesController = new PermissoesUsuarioController();

    if(!empty($_GET['ativar'])) {
        $pessoa = $pessoasController->getById($_GET['ativar']);
        $pessoasController->ativar($pessoa);
    } else if(!empty($_GET['inativar'])) {
        $pessoa = $pessoasController->getById($_GET['inativar']);
        $pessoasController->inativar($pessoa);
    }
    ?>

    <div class="modal fade" id="modalPermissoes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Permissões do usuário</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="permissoesDetails"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-offset-4 col-lg-4">
            <div class="row">
                <input type="text" name="pesquisar" id="pesquisar" onchange="consultar('#tableUsuarios', 'pessoas', this.value)" class="form-control input-lg">
                <br/>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Lista de usuários</b>
            </h3>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover table-striped" id="tableUsuarios">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Telefones</th>
                                <th>Endereços</th>
                                <th>Permisões</th>
                                <th>Tipo de usuário</th>
                                <th>Opções</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            foreach ($pessoasController->getAll() as $pessoa) {
                                $tipoPessoa = $tipoPessoaController->getByPessoa($pessoa->getId());
                                $telefone = $telefonesController->getByPessoa($pessoa->getId());
                                $endereco = $enderecosController->getByPessoa($pessoa->getId());
                                $cidade = $cidadesController->getById($endereco->getIdCidade());
                                $estado = $estadosController->getById($cidade->getIdEstado());
                                $permissoes = $permissoesController->getByPessoa($pessoa->getId());
                                ?>
                                <tr>
                                    <td><?php echo $pessoa->getNome() ?> </td>
                                    <td><?php echo $pessoa->getCPF() ?> </td>
                                    <td><?php echo $pessoa->getEmail() ?> </td>
                                    <td><?php echo ($pessoa->getIsAtivo()) ? 'Ativo' : 'Inativo' ?> </td>
                                    <td><?php echo ($telefone == null) ? 'Sem número' : $telefone->getNumeroTelefone() ?></td>
                                    <td>
                                        <?php
                                        echo $endereco->getRua() . ', ' . $endereco->getNumero() . ', ' . $endereco->getComplemento() . ', ' . $endereco->getBairro();
                                        echo '<br/>' . $cidade->getNome() . '/ ' . $estado->getSigla();
                                        echo '<br/>' . $endereco->getCep();
                                        ?>
                                    </td>
                                    <td><a href="" data-toggle="modal" data-target="#modalPermissoes"
                                           onclick="consultar('#permissoesDetails', 'permissoes', <?php echo $pessoa->getId() ?>)">Visualizar</a>
                                    </td>
                                    <td><?php echo $tipoPessoa->getNome() ?></td>
                                    <td>
                                        <?php
                                        if (!$pessoa->getIsAtivo()) {
                                            ?>
                                            <a href="<?php echo URL_HOST ?>/admin/form_visualizar_usuario.php?ativar=<?php echo $pessoa->getId() ?>">Ativar</a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?php echo URL_HOST ?>/admin/form_visualizar_usuario.php?inativar=<?php echo $pessoa->getId() ?>">Inativar</a>
                                            <?php
                                        }
                                        ?>
                                        <a href="<?php echo URL_HOST ?>/admin/form_editar_usuario.php?editar=<?php echo $pessoa->getId() ?>">Editar</a>
                                    </td>
                                </tr>

                                <?php
                            }
                            ?>
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        function consultar(idDiv, controller, search) {
            $.ajax({
                type: "POST",
                url: "../call_webservice.php?request=get",
                data: "controller=" + controller + "&search=" + search,
                success: function (data) {
                    $(idDiv).html(data);
                }
            });
        }
    </script>

    <?php

    include_once 'footer.php';
} else {
    echo 'Você não possui permissão para acessar essa funcionalidade.';
}
