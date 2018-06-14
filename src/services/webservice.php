<?php
session_start();

include_once '../configs.php';
include_once ROOT_PATH . '/functions.php';
include_once ROOT_PATH . '/controller/PermissoesUsuarioController.php';
include_once ROOT_PATH . '/controller/PessoasController.php';
include_once ROOT_PATH . '/controller/TipoPessoaController.php';
include_once ROOT_PATH . '/controller/TelefonesController.php';
include_once ROOT_PATH . '/controller/EnderecosController.php';
include_once ROOT_PATH . '/controller/CidadesController.php';
include_once ROOT_PATH . '/controller/EstadosController.php';

$permissoesController = new PermissoesUsuarioController();
$pessoasController = new PessoasController();
$tipoPessoaController = new TipoPessoaController();
$telefonesController = new TelefonesController();
$enderecosController = new EnderecosController();
$cidadesController = new CidadesController();
$estadosController = new EstadosController();

switch($_GET['request']){
    case 'get':
        switch($_POST['controller']) {
            case 'permissoes':
                switch ($_POST['method']) {
                    case 'getListPermissoes':
                        $result = $permissoesController->getByPessoa($_POST['data']);
                        $output = '<ul style="list-style-type: none">';

                        foreach ($result as $permissao) {
                            $output .= '<li>' . ucfirst($permissao->getNome()) . '</li>';
                        }

                        echo $output;
                        break;

                }
                break;

            case 'pessoas':
                switch ($_POST['method']) {
                    case 'getTablePessoas':
                        $result = $pessoasController->getByNome($_POST['data']);
                        $output = '<thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Telefones</th>
                                <th>Endereços</th>
                                <th>Permisões</th>
                                <th>Tipo de usuário</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>';

                        foreach ($result as $pessoa) {
                            $tipoPessoa = $tipoPessoaController->getByPessoa($pessoa->getId());
                            $telefone = $telefonesController->getByPessoa($pessoa->getId());
                            $endereco = $enderecosController->getByPessoa($pessoa->getId());
                            $cidade = $cidadesController->getById($endereco->getIdCidade());
                            $estado = $estadosController->getById($cidade->getIdEstado());
                            $permissoes = $permissoesController->getByPessoa($pessoa->getId());

                            $status = ($pessoa->getIsAtivo()) ? 'Ativo' : 'Inativo';
<<<<<<< HEAD
                            $linkAlteraStatus = (!$pessoa->getIsAtivo())
                                ? '<a href="' . URL_HOST . '/admin/visualizar_usuario.php?ativar=' . $pessoa->getId() . '">Ativar</a>'
                                : '<a href="' . URL_HOST . '/admin/visualizar_usuario.php?inativar=' . $pessoa->getId() . '">Inativar</a>';
=======

                            if(possui_permissao($_SESSION['login']['id_pessoa'], 24)) {
                                $linkAlteraStatus = (!$pessoa->getIsAtivo())
                                    ? '<a href="' . URL_HOST . '/admin/visualizar_usuario.php?ativar=' . $pessoa->getId() . '">Ativar</a>'
                                    : '<a href="' . URL_HOST . '/admin/visualizar_usuario.php?inativar=' . $pessoa->getId() . '">Inativar</a>';
                            }

                            if(possui_permissao($_SESSION['login']['id_pessoa'], 20)) {
                                $linkEditar = '<a href="' . URL_HOST. '/admin/form_editar_usuario.php?editar=' . $pessoa->getId() . '">Editar</a>';
                            }

>>>>>>> develop
                            $output .= '<tr>
                                    <td>' . $pessoa->getNome() . '</td>
                                    <td>' . $pessoa->getCPF() . '</td>
                                    <td>' . $pessoa->getEmail() . '</td>
                                    <td>' . $status . '</td>
                                    <td>' . $telefone->getNumeroTelefone() . '</td>
                                    <td>' .
                                $endereco->getRua() . ', ' . $endereco->getNumero() . ', ' . $endereco->getComplemento() . ', ' . $endereco->getBairro() .
                                '<br/>' . $cidade->getNome() . '/ ' . $estado->getSigla() .
                                '<br/>' . $endereco->getCep() . '                                   
                                    </td>
                                    <td><a href="" data-toggle="modal" data-target="#modalPermissoes"
                                           onclick="consultar(\'#permissoesDetails\', \'permissoes\', \'getListPermissoes\',' . $pessoa->getId() . ')">Visualizar</a>
                                    </td>
                                    <td>' . $tipoPessoa->getNome() . '</td>
                                    <td>' . $linkAlteraStatus . '
                                        ' . $linkEditar . '
                                    </td>
                                </tr>';

                        }

                        $output .= '</tbody>';

                        echo $output;
                        break;

                }

                break;

        }

        break;

}