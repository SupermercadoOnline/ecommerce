<?php
session_start();
include_once dirname(__DIR__) . '/header_html_section.php';
include_once ROOT_PATH . '/controller/PermissoesUsuarioController.php';

$permissoesController = new PermissoesUsuarioController();
$permissoes = $permissoesController->getByPessoa($_SESSION['login']['id_pessoa']);
?>

<body style="padding-top: 70px !important; background-color: whitesmoke !important;">

<nav id="navbar-admin" class="navbar-fixed-top navbar-default">

    <div class="container">

        <a href="#" class="navbar-brand">
            <img src="<?php echo URL_IMG_DIR ?>/logo.png" width="200" height="100" style="margin-top: -40px;margin-left: -25px" alt="Brand">
        </a>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="navbarDropdownUsuarios" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <b>
                        Usuários
                        <span class="caret"></span>
                    </b>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsuarios">
                    <?php
                    $permissaoCadastrar = 19;
                    foreach ($permissoes as $permissao) {
                        if($permissao->getId() == $permissaoCadastrar) {
                            ?>
                            <li>
                                <a href="<?php echo URL_HOST?>/admin/form_cadastrar_usuario.php">
                                    <b>Novo</b>
                                </a>
                            </li>
                            <?php
                           break;
                        }
                    }
                    ?>
                    <?php
                    $permissaoVisualizar = 18;
                    foreach ($permissoes as $permissao) {
                        if ($permissao->getId() == $permissaoVisualizar) {
                            ?>
                            <li>
                                <a href="<?php echo URL_HOST ?>/admin/form_visualizar_usuario.php">
                                    <b>Visualizar</b>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="navbarDropdownProdutos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <b>
                        Produtos
                        <span class="caret"></span>
                    </b>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownProdutos">
                    <li>
                        <a href="<?php echo URL_HOST ?>/admin/form_cadastrar_produto.php">
                            <b>Novo</b>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URL_HOST?>/admin/form_visualizar_produto.php" class="dropdown-item">
                            <b>Visualizar</b>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URL_HOST?>/admin/form_cadastrar_categoria_produto.php">
                            <b>Cadastrar categorias</b>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>

</nav>

<div class="container">