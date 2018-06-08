<?php
session_start();

include_once '../configs.php';

include_once ROOT_PATH . '/controller/PessoasController.php';
include_once ROOT_PATH . '/controller/TipoPessoaController.php';

if($_POST["acessar"]) {
    $pessoas = new PessoasController();
    $pessoa = $pessoas->getByEmail($_POST["email"]);

    if($pessoa instanceof Pessoas) {
        if(password_verify($_POST["senha"], $pessoa->getSenha())) {
            $_SESSION['login']['id_pessoa'] = $pessoa->getId();
            $_SESSION['login']['nome_pessoa'] = $pessoa->getNome();

            $tipoPessoa = new TipoPessoaController();
            $tipo = $tipoPessoa->getByPessoa($pessoa->getId());

            if($tipo->getId() == 1) {
                header('Location:' . URL_HOST . '/admin/');
            } else {
                header('Location: ' . URL_HOST . '/cliente/');
            }

        }
    }
}

include_once 'header.php';

?>

<div class="col-lg-offset-4 col-lg-4">
    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title text-center">
                <b>Acessar o sistema</b>
            </h3>
        </div>

        <div class="panel-body">

            <form action="<?php echo URL_HOST ?>/form_login.php" method="post">

                <div class="row">

                    <div class="col-lg-12">
                        <label for="email">Email:</label>
                        <input id="email" name="email" type="email" class="form-control input-lg">
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <label for="senha">Senha: </label>
                        <input id="senha" name="senha" type="password" class="form-control input-lg">
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <hr/>
                        <input type="submit" class="btn btn-default btn-lg center-block" name="acessar" value="Acessar">
                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<?php
include_once 'footer.php';
