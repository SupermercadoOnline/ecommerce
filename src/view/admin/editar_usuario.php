<?php
session_start();
include_once '../../functions.php';

$idPessoa = $_SESSION['login']['id_pessoa'];
if(possuiPermissao($idPessoa, 20)) {

    include_once 'header.php';
    include_once ROOT_PATH . '/controller/PessoasController.php';
    include_once ROOT_PATH . '/controller/PermissoesUsuarioController.php';
    include_once ROOT_PATH . '/controller/EstadosController.php';
    include_once ROOT_PATH . '/controller/CidadesController.php';
    include_once ROOT_PATH . '/controller/TelefonesController.php';
    include_once ROOT_PATH . '/controller/EnderecosController.php';

    $permissoesController = new PermissoesUsuarioController();
    $pessoasController = new PessoasController();
    $estadosController = new EstadosController();
    $cidadesController = new CidadesController();
    $telefonesController = new TelefonesController();
    $enderecosController = new EnderecosController();

    if ($_POST["salvar"]) {
        $pessoa = new Pessoas($_POST['idPessoa'],
            $_POST['nome'],
            null,
            $_POST['cpf'],
            null,
            $_POST['email'],
            null,
            $_POST['pessoaIsAtivo'],
            0);
        $pessoasController->salvar($pessoa);

        if(possuiPermissao($idPessoa, 22)) {
            $telefone = new Telefones($_POST['idTelefone'],
                $pessoa->getId(),
                $_POST['numeroTelefone'],
                $_POST['telefoneIsAtivo']);
            $telefonesController->salvar($telefone);
        }

        if(possuiPermissao($idPessoa, 21)) {
            $endereco = new Enderecos($_POST['idEndereco'],
                $pessoa->getId(),
                $_POST['cidade'],
                $_POST['rua'],
                $_POST['bairro'],
                $_POST['numero'],
                $_POST['cep'],
                $_POST['complemento'],
                $_POST['enderecoIsAtivo']);
            $enderecosController->salvar($endereco);
        }

        if(possuiPermissao($idPessoa, 23)) {
            $permissoes = array_merge((array)$_POST["permissoesAdmin"], (array)$_POST["permissoesCategoria"],
                (array)$_POST["permissoesClientes"], (array)$_POST["permissoesVendas"], (array)$_POST["permissoesProdutos"], (array)$_POST["permissoesPromo"]);

            $permissoesController->delete($pessoa->getId());
            foreach ($permissoes as $permissao) {
                $permissoesController->salvar($pessoa, $permissao);
            }
        }

    }

    $pessoa = $pessoasController->getById($_GET['editar']);
    $permissoes = $permissoesController->getByPessoa($pessoa->getId());
    $endereco = $enderecosController->getByPessoa($pessoa->getId());
    $telefone = $telefonesController->getByPessoa($pessoa->getId());
    $cidade = $cidadesController->getById($endereco->getIdCidade());
    $estado = $estadosController->getById($cidade->getIdEstado());

    ?>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Editar usuário</b>
            </h3>
        </div>

        <div class="panel-body">

            <form action="<?php echo URL_HOST ?>/admin/form_editar_usuario.php?editar=<?php echo $pessoa->getId() ?>" method="post">

                <div class="row">

                    <div class="col-lg-4">

                        <input type="hidden" name="idPessoa" id="idPessoa" value="<?php echo $pessoa->getId() ?>">
                        <input type="hidden" name="pessoaIsAtivo" id="pessoaIsAtivo" value="<?php echo $pessoa->getIsAtivo() ?>">

                        <label for="nome">Nome:</label>
                        <input id="nome" name="nome" type="text" class="form-control input-lg" value="<?php echo $pessoa->getNome() ?>">

                        <label for="email">Email: </label>
                        <input id="email" name="email" type="email" class="form-control input-lg" value="<?php echo $pessoa->getEmail() ?>">

                    </div>

                    <div class="col-lg-4">

                        <label for="cpf">CPF: </label>
                        <input id="cpf" name="cpf" type="text" class="form-control input-lg" value="<?php echo $pessoa->getCpf() ?>">

                    </div>

                    <div class="col-lg-4">
                        <?php
                        if(possuiPermissao($idPessoa, 22)) {
                            ?>
                            <input type="hidden" name="idTelefone" id="idTelefone" value="<?php echo $telefone->getId() ?>">
                            <input type="hidden" name="telefoneIsAtivo" id="telefoneIsAtivo" value="<?php echo $telefone->getIsAtivo() ?>">

                            <label for="numeroTelefone">Número de telefone: </label>
                            <input id="numeroTelefone" name="numeroTelefone" type="text" class="form-control input-lg"
                                   value="<?php echo $telefone->getNumeroTelefone() ?>">
                            <?php
                        }
                        ?>
                    </div>

                </div>

                <?php
                if(possuiPermissao($idPessoa, 21)) {
                    ?>
                    <hr/>

                    <div class="row">

                        <div class="col-lg-4">

                            <input type="hidden" name="idEndereco" id="idEndereco" value="<?php echo $endereco->getId() ?>">
                            <input type="hidden" name="enderecoIsAtivo" id="enderecoIsAtivo" value="<?php echo $endereco->getIsAtivo() ?>">

                            <label for="estado">Estado: </label>
                            <select id="estado" name="estado" class="form-control input-lg">
                                <?php
                                foreach ($estadosController->getAll() as $estados) {
                                    $selected = ($estados->getId() == $estado->getId()) ? 'selected' : null;
                                    echo "<option value='" . $estados->getId() . "' " . $selected . "> " . $estados->getNome() . "</option>";
                                }
                                ?>
                            </select>

                            <label for="bairro">Bairro: </label>
                            <input id="bairro" name="bairro" type="text" class="form-control input-lg"
                                   value="<?php echo $endereco->getBairro() ?>">

                            <label for="complemento">Complemento: </label>
                            <input id="complemento" name="complemento" type="text" class="form-control input-lg"
                                   value="<?php echo $endereco->getComplemento() ?>">

                        </div>

                        <div class="col-lg-4">

                            <label for="cidade">Cidade: </label>
                            <select id="cidade" name="cidade" class="form-control input-lg">
                                <?php
                                foreach ($cidadesController->getAll() as $cidades) {
                                    $selected = ($cidades->getId() == $cidade->getId()) ? 'selected' : null;
                                    echo "<option value='" . $cidades->getId() . "' " . $selected . "> " . $cidades->getNome() . "</option>";
                                }
                                ?>
                            </select>


                            <label for="numero">Número da casa: </label>
                            <input id="numero" name="numero" type="text" class="form-control input-lg"
                                   value="<?php echo $endereco->getNumero() ?>">

                        </div>

                        <div class="col-lg-4">

                            <label for="rua">Rua: </label>
                            <input id="rua" name="rua" type="text" class="form-control input-lg"
                                   value="<?php echo $endereco->getRua() ?>">

                            <label for="cep">CEP: </label>
                            <input id="cep" name="cep" type="text" class="form-control input-lg"
                                   value="<?php echo $endereco->getCep() ?>">

                        </div>

                    </div>
                    <?php
                }

                if(possuiPermissao($idPessoa, 23)) {
                    ?>
                    <hr/>

                    <div class="row">
                        <h4 style="padding-left: 15px"><b>Permissões</b></h4><br/>

                        <div class="col-lg-4">

                            <label for="permissoesAdmin[]">Administradores: </label><br/>
                            <?php
                            foreach ($permissoesController->getByNomePermissoes('administradores') as $permissao) {
                                $checked = null;
                                foreach ($permissoes as $permissaoUsuario) {
                                    if ($permissao->getId() == $permissaoUsuario->getId()) {
                                        $checked = 'checked';
                                        break;
                                    } else {
                                        $checked = null;
                                    }
                                }
                                echo "<input id='permissoesAdmin' name='permissoesAdmin[]' type='checkbox' 
                            class='checkbox-inline input-lg' 
                            value='" . $permissao->getId() . "' " . $checked . "> " . ucfirst(str_replace('administradores__', "", $permissao->getNome())) . "<br/>";
                            }
                            ?>

                            <label for="permissoesCategoria[]">Categoria de produtos: </label><br/>
                            <?php
                            foreach ($permissoesController->getByNomePermissoes('categoria') as $permissao) {
                                $checked = null;
                                foreach ($permissoes as $permissaoUsuario) {
                                    if ($permissao->getId() == $permissaoUsuario->getId()) {
                                        $checked = 'checked';
                                        break;
                                    } else {
                                        $checked = null;
                                    }
                                }
                                echo "<input id='permissoesCategoria' name='permissoesCategoria[]' type='checkbox' 
                            class='checkbox-inline input-lg' 
                            value='" . $permissao->getId() . "' " . $checked . "> " . ucfirst(str_replace('categoria_produtos__', "", $permissao->getNome())) . "<br/>";
                            }
                            ?>

                        </div>

                        <div class="col-lg-4">

                            <label for="permissoesClientes[]">Clientes: </label><br/>
                            <?php
                            foreach ($permissoesController->getByNomePermissoes('clientes') as $permissao) {
                                $checked = null;
                                foreach ($permissoes as $permissaoUsuario) {
                                    if ($permissao->getId() == $permissaoUsuario->getId()) {
                                        $checked = 'checked';
                                        break;
                                    } else {
                                        $checked = null;
                                    }
                                }
                                echo "<input id='permissoesClientes' name='permissoesClientes[]' type='checkbox' 
                            class='checkbox-inline input-lg' 
                            value='" . $permissao->getId() . "' " . $checked . "> " . ucfirst(str_replace('clientes__', "", $permissao->getNome())) . "<br/>";
                            }
                            ?>

                            <label for="permissoesVendas[]">Vendas: </label><br/>
                            <?php
                            foreach ($permissoesController->getByNomePermissoes('vendas') as $permissao) {
                                $checked = null;
                                foreach ($permissoes as $permissaoUsuario) {
                                    if ($permissao->getId() == $permissaoUsuario->getId()) {
                                        $checked = 'checked';
                                        break;
                                    } else {
                                        $checked = null;
                                    }
                                }
                                echo "<input id='permissoesVendas' name='permissoesVendas[]' type='checkbox' 
                            class='checkbox-inline input-lg' 
                            value='" . $permissao->getId() . "' " . $checked . "> " . ucfirst(str_replace('vendas__', "", $permissao->getNome())) . "<br/>";
                            }
                            ?>

                        </div>

                        <div class="col-lg-4">

                            <label for="permissoesProdutos[]">Produtos: </label><br/>
                            <?php
                            foreach ($permissoesController->getByNomePermissoes('produtos') as $permissao) {
                                $checked = null;
                                foreach ($permissoes as $permissaoUsuario) {
                                    if ($permissao->getId() == $permissaoUsuario->getId()) {
                                        $checked = 'checked';
                                        break;
                                    } else {
                                        $checked = null;
                                    }
                                }
                                echo "<input id='permissoesProdutos' name='permissoesProdutos[]' type='checkbox' 
                            class='checkbox-inline input-lg' 
                            value='" . $permissao->getId() . "' " . $checked . "> " . ucfirst(str_replace('produtos__', "", $permissao->getNome())) . "<br/>";
                            }
                            ?>

                            <label for="permissoesPromo[]" style="padding-top: 50px">Promoções: </label><br/>
                            <?php
                            foreach ($permissoesController->getByNomePermissoes('promocoes') as $permissao) {
                                $checked = null;
                                foreach ($permissoes as $permissaoUsuario) {
                                    if ($permissao->getId() == $permissaoUsuario->getId()) {
                                        $checked = 'checked';
                                        break;
                                    } else {
                                        $checked = null;
                                    }
                                }
                                echo "<input id='permissoesPromo' name='permissoesPromo[]' type='checkbox' 
                            class='checkbox-inline input-lg' 
                            value='" . $permissao->getId() . "' " . $checked . "> " . ucfirst(str_replace('promocoes__', "", $permissao->getNome())) . "<br/>";
                            }
                            ?>

                        </div>

                    </div>
                    <?php
                }
                ?>

                <hr/>
                <input type="submit" class="btn btn-default btn-lg" name="salvar" value="Salvar">

            </form>

        </div>

    </div>

    <?php

    include_once 'footer.php';
} else {
    echo 'Você não possui permissão para acessar essa funcionalidade.';
}

