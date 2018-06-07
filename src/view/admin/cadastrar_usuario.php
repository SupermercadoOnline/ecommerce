<?php
include_once 'header.php';
include_once '../../model/PessoasDAO.php';
include_once '../../model/TipoPessoaDAO.php';
include_once '../../model/PermissoesUsuarioDAO.php';
include_once '../../model/EstadosDAO.php';
include_once '../../model/CidadesDAO.php';
include_once '../../model/TelefonesDAO.php';
include_once '../../model/EnderecosDAO.php';

$tiposPermissoesDAO = new PermissoesUsuarioDAO();
if($_POST["cadastrar"]) {
    $pessoa = new PessoasBean(null,
        $_POST["nome"],
        null,
        $_POST["cpf"],
        null,
        $_POST["email"],
        $_POST["senha"],
        null,
        0);
    $pessoasDAO = new PessoasDAO();
    $pessoa = $pessoasDAO->salvar($pessoa);

    if ($pessoa instanceof PessoasBean) {
        $tiposPessoasDAO = new TipoPessoaDAO();
        $tiposPessoasDAO->salvar($pessoa, 1);

        foreach ($_POST["permissoes"] as $permissao) {
            $tiposPermissoesDAO->salvar($pessoa, $permissao);
        }

        $telefonesDAO = new TelefonesDAO();
        $telefone = new TelefonesBean(null,
            $pessoa->getId(),
            $_POST["numeroTelefone"],
            null);

        $telefonesDAO->salvar($telefone);

        $enderecosDAO = new EnderecosDAO();
        $endereco = new EnderecosBean(null,
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

                        <label for="cpf">CPF: </label>
                        <input id="cpf" name="cpf" type="text" class="form-control input-lg">

                        <label for="email">Email: </label>
                        <input id="email" name="email" type="email" class="form-control input-lg">

                        <label for="senha">Senha: </label>
                        <input id="senha" name="senha" type="password" class="form-control input-lg">

                        <label for="permissoes[]">Permissões: </label><br/>
                        <?php
                        $permissoes = $tiposPermissoesDAO->getByPermissoes();
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoes' name='permissoes[]' type='checkbox' 
                            class='checkbox-inline input-lg' value='" . $permissao->getId() . "'> " . $permissao->getNome() . "<br/>";
                        }
                        ?>
                    </div>

                    <div class="col-lg-4">

                        <label for="numeroTelefone">Número de telefone: </label>
                        <input id="numeroTelefone" name="numeroTelefone" type="text" class="form-control input-lg">

                        <hr/>

                        <label for="estado">Estado: </label>
                        <select id="estado" name="estado" class="form-control input-lg">
                            <?php
                            $estados = new EstadosDAO();
                            foreach ($estados->getAll() as $estado) {
                                echo "<option value='" . $estado->getId() . "'> " . $estado->getNome() . "</option>";
                            }
                            ?>
                        </select>

                        <label for="cidade">Cidade: </label>
                        <select id="cidade" name="cidade" class="form-control input-lg">
                            <?php
                            $cidades = new CidadesDAO();
                            foreach ($cidades->getAll() as $cidade) {
                                echo "<option value='" . $cidade->getId() . "'> " . $cidade->getNome() . "</option>";
                            }
                            ?>
                        </select>

                        <label for="rua">Rua: </label>
                        <input id="rua" name="rua" type="text" class="form-control input-lg">

                        <label for="bairro">Bairro: </label>
                        <input id="bairro" name="bairro" type="text" class="form-control input-lg">

                        <label for="numero">Número da casa: </label>
                        <input id="numero" name="numero" type="text" class="form-control input-lg">

                        <label for="cep">CEP: </label>
                        <input id="cep" name="cep" type="text" class="form-control input-lg">

                        <label for="complemento">Complemento: </label>
                        <input id="complemento" name="complemento" type="text" class="form-control input-lg">
                    </div>

                    <div class="col-lg-4">
                        <br/>
                        <input type="submit" class="form-control input-lg" name="cadastrar" value="Cadastrar">
                    </div>

                </div>

            </form>

        </div>

    </div>

<?php
include_once 'footer.php';

