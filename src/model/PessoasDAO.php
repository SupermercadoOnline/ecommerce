<?php
include_once 'DAOInterface.php';
include_once 'PessoasBean.php';

class PessoasDAO extends DAOInterface
{

    protected function select($query): array
    {
        $listaDePessoas = array();
        $pessoas = $this->mysqli->query($query);
        while($row = $pessoas->fetch_array()) {
            $listaDePessoas[] = new PessoasBean($row['id'], $row['nome'],
                $row['razaoSocial'], $row['cpf'], $row['cnpj'], $row['email'], $row['senha'],
                $row['isAtivo'], $row['isReceberAlertasPromocao']);
        }

        return $listaDePessoas;
    }

    protected function insert($bean)
    {
        // TODO: Implement insert() method.
    }

    protected function update($bean)
    {
        // TODO: Implement update() method.
    }

    protected function salvar($bean)
    {
        // TODO: Implement salvar() method.
    }

    protected function delete($bean)
    {
        // TODO: Implement delete() method.
    }
}