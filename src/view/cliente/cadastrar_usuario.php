<?php
include_once 'header.php';

include_once ROOT_PATH . '/controller/PessoasController.php';
include_once ROOT_PATH . '/controller/TipoPessoaController.php';
include_once ROOT_PATH . '/controller/EstadosController.php';
include_once ROOT_PATH . '/controller/CidadesController.php';
include_once ROOT_PATH . '/controller/TelefonesController.php';
include_once ROOT_PATH . '/controller/EnderecosController.php';

if ($_POST["salvar"]) {
    $pessoa = new Pessoas(null,
        $_POST["nome"],
        $_POST["razaoSocial"],
        $_POST["cpf"],
        $_POST["cnpj"],
        $_POST["email"],
        $_POST["senha"],
        null,
        0);
    $pessoasController = new PessoasController();
    $pessoa = $pessoasController->salvar($pessoa);

    if ($pessoa instanceof Pessoas) {
        $tipoPessoaController = new TipoPessoaController();
        $tipoPessoaController->salvar($pessoa, 2);

        $telefonesController = new TelefonesController();
        $telefone = new Telefones(null,
            $pessoa->getId(),
            $_POST["numeroTelefone"],
            null);

        $telefonesController->salvar($telefone);

        $enderecosController = new EnderecosController();
        $endereco = new Enderecos(null,
            $pessoa->getId(),
            $_POST["cidade"],
            $_POST["rua"],
            $_POST["bairro"],
            $_POST["numero"],
            $_POST["cep"],
            $_POST["complemento"],
            null);

        $enderecosController->salvar($endereco);
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

            <form action="<?php echo URL_HOST ?>/cliente/form_cadastrar_usuario.php" method="post">

                <div class="row">

                    <div class="col-lg-4">

                        <label for="nome">Nome:</label>
                        <input id="nome" name="nome" type="text" class="form-control input-lg">

                        <label for="numeroTelefone">Número de telefone: </label>
                        <input id="numeroTelefone" name="numeroTelefone" type="text" class="form-control input-lg">

                    </div>

                    <div class="col-lg-4">

                        <label for="email">Email: </label>
                        <input id="email" name="email" type="email" class="form-control input-lg">

                    </div>

                    <div class="col-lg-4">

                        <label for="senha">Senha: </label>
                        <input id="senha" name="senha" type="password" class="form-control input-lg">

                    </div>

                </div>

                <hr/>

                <div class="row">
                    <h4 style="padding-left: 15px"><b>Dados pessoais</b></h4><br/>

                    <div class="col-lg-4">

                        <input type="radio" id="pessoaJuridica" name="pessoaEscolhida" onclick="adicionarCampos(this.value)" class="radio-inline input-lg" value="J">
                        <label for="pessoaFisica">Pessoa Jurídica</label>

                        <input type="radio" id="pessoaFisica" name="pessoaEscolhida" onclick="adicionarCampos(this.value)" class="radio-inline input-lg" value="F">
                        <label for="pessoaFisica">Pessoa Física</label>

                    </div>

                </div>

                <div class="row" id="adicionarDadosPessoais"></div>

                <hr/>

                <div class="row">
                    <h4 style="padding-left: 15px"><b>Endereço</b></h4><br/>

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
                <input type="submit" class="btn btn-default btn-lg center-block" name="salvar" value="Salvar">

            </form>

        </div>

    </div>

<script>
    function adicionarCampos(tipoPessoa) {
        if(tipoPessoa == 'F') {
            $('#adicionarDadosPessoais').html('<div class="col-lg-4">\n' +
                '                    <label for="cpf">CPF: </label>\n' +
                '                    <input id="cpf" name="cpf" type="text" class="form-control input-lg">\n' +
                '                </div>');
        } else if(tipoPessoa == 'J') {
            $('#adicionarDadosPessoais').html('<div class="col-lg-4">\n' +
                '                    <label for="razaoSocial">Razão Social: </label>\n' +
                '                    <input id="razaoSocial" name="razaoSocial" type="text" class="form-control input-lg">\n' +
                '                </div>\n' +
                '                <div class="col-lg-4">\n' +
                '                    <label for="cnpj">CNPJ: </label>\n' +
                '                    <input id="cnpj" name="cnpj" type="text" class="form-control input-lg">\n' +
                '                </div>');
        }
    }
</script>

<?php

include_once 'footer.php';

