<?php
include_once 'header.php';
include_once '../../model/PessoasDAO.php';
include_once '../../model/TiposPessoasDAO.php';
include_once '../../model/TiposPermissoesDAO.php';

$tiposPermissoesDAO = new TiposPermissoesDAO();
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
    $tiposPessoasDAO = new TiposPessoasDAO();

    $pessoa = $pessoasDAO->salvar($pessoa);
    if ($pessoa instanceof PessoasBean && $pessoa->getId() != null) {
        $tiposPessoasDAO->salvar($pessoa, 1);
        foreach ($_POST["permissoes"] as $permissao) {
            $tiposPermissoesDAO->salvar($pessoa, $permissao);
        }
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

                        <label for="permissoes[]">Permissões: </label>
                        <?php
                        $permissoes = $tiposPermissoesDAO->consultarPermissoes();
                        foreach ($permissoes as $permissao) {
                            echo "<input id='permissoes' name='permissoes[]' type='checkbox' 
                            class='checkbox input-lg' value='" . $permissao->getId() . "'>" . $permissao->getNome() . "<br/>";
                        }
                        ?>

                        <br/>
                        <input type="submit" class="form-control" name="cadastrar" value="Cadastrar">
                    </div>
                </div>
            </form>

        </div>

    </div>

<?php
include_once 'footer.php';

