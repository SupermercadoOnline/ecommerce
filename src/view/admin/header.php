<?php
include_once dirname(__DIR__) . '/header_html_section.php';
?>

<body style="padding-top: 70px !important; background-color: whitesmoke !important;">

<nav id="navbar-admin" class="navbar-fixed-top navbar-default">

    <div class="container">

        <a href="#" class="navbar-brand">
            <img src="#" alt="Brand">
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
                    <li>
                        <a href="<?php echo URL_HOST?>/admin/form_cadastrar_usuario.php">
                            <b>Novo</b>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <b>Editar</b>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <b>Inativar</b>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <b>Consultar</b>
                        </a>
                    </li>
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
                        <a href="#" class="dropdown-item">
                            <b>Visualizar</b>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>

</nav>

<div class="container">