<?php
session_start();
include_once '../../configs.php';
include_once '../../controller/TipoPessoaController.php';

$tipoPessoaController = new TipoPessoaController();
$tipoPessoa = $tipoPessoaController->getByPessoa($_SESSION['login']['id_pessoa']);

if(!empty($_SESSION['login']['id_pessoa'])) {
    if($tipoPessoa->getId() == 1) {
        include_once '../../view/admin/header.php';
        include_once '../../view/admin/footer.php';
    } else {
        echo 'Um erro aconteceu, por favor revise suas credenciais.';
    }
} else {
    header('Location: ../form_login.php');
}
