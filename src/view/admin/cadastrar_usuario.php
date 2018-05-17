<?php
include_once 'header.php';
include_once '../../model/PessoasDAO.php';
include_once '../../model/PessoasBean.php';

if($_POST["cadastrar"]) {
    $pessoa = new PessoasBean(null,
        $_POST["nome"],
        null,
        $_POST["cpf"],
        null,
        $_POST["email"],
        $_POST["senha"],
        null,
        null);
    $dao = new PessoasDAO();

    $pessoa = $dao->salvar($pessoa);
    if($pessoa instanceof PessoasBean && $pessoa->getId() != null) {
        ?>

        <div class="panel-body">
            <div class="row">
                <div class="alert alert-success col-lg-4">
                    Usuário cadastrado com sucesso!
                    <button class="close" data-dismiss="alert">X</button>
                </div>
            </div>
        </div>

        <?php
    } else {
        ?>

        <div class="panel-body">
            <div class="row">
                <div class="alert alert-danger col-lg-4">
                    Não foi possível cadastrar esse usuário!
                    <button class="close" data-dismiss="alert">X</button>
                </div>
            </div>
        </div>

        <?php
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

                        <br/>
                        <input type="submit" class="form-control" name="cadastrar" value="Cadastrar">
                    </div>
                </div>
            </form>

        </div>

    </div>

<?php
include_once 'footer.php';

