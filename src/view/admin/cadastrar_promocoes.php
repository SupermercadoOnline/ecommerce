<?php
session_start();
include_once '../../functions.php';

if(possui_permissao($_SESSION['login']['id_pessoa'], 26)) {

    include_once 'header.php';
    include_once ROOT_PATH . '/controller/PromocoesController.php';

    $permissoesController = new PermissoesUsuarioController();
    if ($_POST["salvar"]) {

    }
    ?>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Nova promoção</b>
            </h3>
        </div>

        <div class="panel-body">

            <form action="<?php echo URL_HOST ?>/admin/form_cadastrar_promocoes.php" method="post">

                <div class="row">

                    <div class="col-lg-4">

                        <label for="nome">Nome:</label>
                        <input id="nome" name="nome" type="text" class="form-control input-lg">

                        <label for="email">Email: </label>
                        <input id="email" name="email" type="email" class="form-control input-lg">

                    </div>

                    <div class="col-lg-4">

                        <label for="cpf">CPF: </label>
                        <input id="cpf" name="cpf" type="text" class="form-control input-lg">

                        <label for="senha">Senha: </label>
                        <input id="senha" name="senha" type="password" class="form-control input-lg">

                    </div>

                    <div class="col-lg-4">

                        <label for="numeroTelefone">Número de telefone: </label>
                        <input id="numeroTelefone" name="numeroTelefone" type="text" class="form-control input-lg">

                    </div>

                </div>

                <hr/>

                <div class="row">
                    <div class="col-lg-4">

                        <label for="estado">Estado: </label>
                        <select id="estado" name="estado" class="form-control input-lg">
                            <?php
                            $estadosController = new EstadosController();
                            foreach ($estadosController->getAll() as $estado) {
                                echo "<option value='" . $estado->getId() . "'> " . $estado->getNome() . "</option>";
                            }
                            ?>
                        </select>

                        <label for="bairro">Bairro: </label>
                        <input id="bairro" name="bairro" type="text" class="form-control input-lg">

                        <label for="complemento">Complemento: </label>
                        <input id="complemento" name="complemento" type="text" class="form-control input-lg">

                    </div>

                    <div class="col-lg-4">

                        <label for="cidade">Cidade: </label>
                        <select id="cidade" name="cidade" class="form-control input-lg">
                            <?php
                            $cidadesController = new CidadesController();
                            foreach ($cidadesController->getAll() as $cidade) {
                                echo "<option value='" . $cidade->getId() . "'> " . $cidade->getNome() . "</option>";
                            }
                            ?>
                        </select>


                        <label for="numero">Número da casa: </label>
                        <input id="numero" name="numero" type="text" class="form-control input-lg">

                    </div>

                    <div class="col-lg-4">

                        <label for="rua">Rua: </label>
                        <input id="rua" name="rua" type="text" class="form-control input-lg">

                        <label for="cep">CEP: </label>
                        <input id="cep" name="cep" type="text" class="form-control input-lg">

                    </div>

                </div>

                <hr/>

                <div class="row">
                    <h4 style="padding-left: 15px"><strong>Permissões</strong></h4><br/>

                    <div class="col-lg-4">

                        <label for="permissoesAdmin[]">Administradores: </label><br/>
                        <?php
                        $permissoes = $permissoesController->getByNomePermissoes('administradores');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesAdmin' name='permissoesAdmin[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('administradores__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                        <label for="permissoesCategoria[]">Categoria de produtos: </label><br/>
                        <?php
                        $permissoes = $permissoesController->getByNomePermissoes('categoria');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesCategoria' name='permissoesCategoria[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('categoria_produtos__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                    </div>

                    <div class="col-lg-4">

                        <label for="permissoesClientes[]">Clientes: </label><br/>
                        <?php
                        $permissoes = $permissoesController->getByNomePermissoes('clientes');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesClientes' name='permissoesClientes[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('clientes__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                        <label for="permissoesVendas[]">Vendas: </label><br/>
                        <?php
                        $permissoes = $permissoesController->getByNomePermissoes('vendas');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesVendas' name='permissoesVendas[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('vendas__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                    </div>

                    <div class="col-lg-4">

                        <label for="permissoesProdutos[]">Produtos: </label><br/>
                        <?php
                        $permissoes = $permissoesController->getByNomePermissoes('produtos');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesProdutos' name='permissoesProdutos[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('produtos__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                        <label for="permissoesPromo[]" style="padding-top: 50px">Promoções: </label><br/>
                        <?php
                        $permissoes = $permissoesController->getByNomePermissoes('promocoes');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesPromo' name='permissoesPromo[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('promocoes__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                    </div>

                </div>

                <hr/>
                <input type="submit" class="btn btn-default btn-lg center-block" name="salvar" value="Salvar">

            </form>

        </div>

    </div>

    <?php

    include_once 'footer.php';
} else {
    echo 'Um erro aconteceu, por favor revise suas credenciais.';
}

