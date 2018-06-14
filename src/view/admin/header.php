<?php
session_start();

include_once dirname(__DIR__) . '/header_html_section.php';
include_once ROOT_PATH . '/functions.php';

$id_pessoa = $_SESSION['login']['id_pessoa'];
?>

<body style="padding-top: 70px !important; background-color: whitesmoke !important;">

<nav id="navbar-admin" class="navbar-fixed-top navbar-default">

    <div class="container">

        <a href="#" class="navbar-brand" style="margin-top: -20px; margin-left: -15px">
            <h3>Supermercado na</h3>
            <img src="<?php echo URL_IMG_DIR ?>/logo3.png" style="margin-top: -55px; margin-left: 170px" alt="Brand" align="right">
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
                    if (possui_permissao($id_pessoa,19)) {
                        ?>
                        <li>
                            <a href="<?php echo URL_HOST?>/admin/form_cadastrar_usuario.php">
                                <b>Novo</b>
                            </a>
                        </li>
                        <?php
                    }

                    if (possui_permissao($id_pessoa,18)) {
                        ?>
                        <li>
                            <a href="<?php echo URL_HOST ?>/admin/visualizar_usuario.php">
                                <b>Visualizar</b>
                            </a>
                        </li>
                        <?php
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
                    <?php
                    if(possui_permissao($id_pessoa, 5)) {
                        ?>
                        <li>
                            <a href="<?php echo URL_HOST ?>/admin/form_cadastrar_produto.php">
                                <b>Novo</b>
                            </a>
                        </li>
                        <?php
                    }

                    if(possui_permissao($id_pessoa, 6)) {
                        ?>
                        <li>
                            <a href="<?php echo URL_HOST ?>/admin/visualizar_produto.php" class="dropdown-item">
                                <b>Visualizar</b>
                            </a>
                        </li>
                        <?php
                    }

                    if(possui_permissao($id_pessoa, 1)) {
                        ?>
                        <li>
                            <a href="<?php echo URL_HOST ?>/admin/form_cadastrar_categoria_produto.php">
                                <b>Cadastrar categorias</b>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="navbarDropdownUsuarios" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <b>
                        Promoções
                        <span class="caret"></span>
                    </b>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsuarios">
                    <?php
                    if (possui_permissao($id_pessoa,26)) {
                        ?>
                        <li>
                            <a href="<?php echo URL_HOST?>/admin/form_cadastrar_promocoes.php">
                                <b>Nova</b>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
        </ul>

    </div>

</nav>

<div class="container">