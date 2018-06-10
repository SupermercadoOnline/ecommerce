<?php
include_once '../configs.php';
include_once ROOT_PATH . '/controller/PermissoesUsuarioController.php';

switch($_GET['request']){
    case 'get':
        switch ($_POST['controller']) {
            case 'permissoes':
                $permissoesController = new PermissoesUsuarioController();
                $result = $permissoesController->getByPessoa($_POST['idPessoa']);
                $output = '<ul style="list-style-type: none">';

                foreach ($result as $row) {
                    $output .= '<li>' . ucfirst($row->getNome()) . '</li>';
                }

                echo $output;
                break;
        }

        break;
}