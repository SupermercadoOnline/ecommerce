<?php
include_once 'header.php';
include_once ROOT_PATH . '/controller/PessoasController.php';
include_once ROOT_PATH . '/controller/TipoPessoaController.php';
include_once ROOT_PATH . '/controller/PermissoesUsuarioController.php';
include_once ROOT_PATH . '/controller/EstadosController.php';
include_once ROOT_PATH . '/controller/CidadesController.php';
include_once ROOT_PATH . '/controller/TelefonesController.php';
include_once ROOT_PATH . '/controller/EnderecosController.php';

$permissoesUsuarioDAO = new PermissoesUsuarioController();
if($_POST["cadastrar"]) {
    $pessoa = new Pessoas(null,
        $_POST["nome"],
        null,
        $_POST["cpf"],
        null,
        $_POST["email"],
        $_POST["senha"],
        null,
        0);
    $pessoasDAO = new PessoasController();
    $pessoa = $pessoasDAO->salvar($pessoa);

    if ($pessoa instanceof Pessoas) {
        $tipoPessoaDAO = new TipoPessoaController();
        $tipoPessoaDAO->salvar($pessoa, 1);

        $permissoes = array_merge((array)$_POST["permissoesAdmin"], (array)$_POST["permissoesCategoria"],
            (array)$_POST["permissoesClientes"], (array)$_POST["permissoesVendas"], (array)$_POST["permissoesProdutos"], (array)$_POST["permissoesPromo"]);

        foreach ($permissoes as $permissao) {
            $permissoesUsuarioDAO->salvar($pessoa, $permissao);
        }

        $telefonesDAO = new TelefonesController();
        $telefone = new Telefones(null,
            $pessoa->getId(),
            $_POST["numeroTelefone"],
            null);

        $telefonesDAO->salvar($telefone);

        $enderecosDAO = new EnderecosController();
        $endereco = new Enderecos(null,
            $pessoa->getId(),
            $_POST["cidade"],
            $_POST["rua"],
            $_POST["bairro"],
            $_POST["numero"],
            $_POST["cep"],
            $_POST["complemento"],
            null);

        $enderecosDAO->salvar($endereco);
    }
}
?>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Novo usuário</b>
            </h3>
        </div>

        <div class="panel-body">

            <form action="<?php echo URL_HOST ?>/admin/form_cadastrar_usuario.php" method="post">

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
                            $estados = new EstadosController();
                            foreach ($estados->getAll() as $estado) {
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
                            $cidades = new CidadesController();
                            foreach ($cidades->getAll() as $cidade) {
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
                        $permissoes = $permissoesUsuarioDAO->getByNomePermissoes('administradores');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesAdmin' name='permissoesAdmin[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('administradores__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                        <label for="permissoesCategoria[]">Categoria de produtos: </label><br/>
                        <?php
                        $permissoes = $permissoesUsuarioDAO->getByNomePermissoes('categoria');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesCategoria' name='permissoesCategoria[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('categoria_produtos__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                    </div>

                    <div class="col-lg-4">

                        <label for="permissoesClientes[]">Clientes: </label><br/>
                        <?php
                        $permissoes = $permissoesUsuarioDAO->getByNomePermissoes('clientes');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesClientes' name='permissoesClientes[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('clientes__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                        <label for="permissoesVendas[]">Vendas: </label><br/>
                        <?php
                        $permissoes = $permissoesUsuarioDAO->getByNomePermissoes('vendas');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesVendas' name='permissoesVendas[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('vendas__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                    </div>

                    <div class="col-lg-4">

                        <label for="permissoesProdutos[]">Produtos: </label><br/>
                        <?php
                        $permissoes = $permissoesUsuarioDAO->getByNomePermissoes('produtos');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesProdutos' name='permissoesProdutos[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('produtos__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                        <label for="permissoesPromo[]" style="padding-top: 50px">Promoções: </label><br/>
                        <?php
                        $permissoes = $permissoesUsuarioDAO->getByNomePermissoes('promocoes');
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoesPromo' name='permissoesPromo[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . ucfirst(str_replace('promocoes__', "", $permissao->getNome())) . "<br/>";
                        }
                        ?>

                    </div>

                </div>

                <hr/>
                <input type="submit" class="btn btn-default btn-lg" name="cadastrar" value="Cadastrar">

            </form>

        </div>

    </div>

<?php
include_once 'footer.php';

