<?php
include_once 'MySqlDAO.php';
include_once 'TipoPessoaBean.php';
include_once 'PessoasBean.php';

class TipoPessoaDAO
{
    public function getAll()
    {
        return $this->select("select * from tipos_possiveis_pessoa order by nome");
    }

    public function getByPessoa($id)
    {
        return $this->select(
            "select * 
                   from tipos_possiveis_pessoa 
                   inner join tipo_pessoa tipo_pessoa ON tipos_possiveis_pessoa.id = tipo_pessoa.id_tipo
                   where tipo_pessoa.id_pessoa = '$id'"
        )[0];
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new TipoPessoaBean($row['id'], $row['nome']);
        }

        return $lista;
    }

    public function salvar($pessoaBean, $id_tipo)
    {
        if ($pessoaBean instanceof PessoasBean) {
            $query = "INSERT INTO tipo_pessoa (id_pessoa, id_tipo) VALUES (?, ?)";

            $params = array(
                $pessoaBean->getId(),
                $id_tipo
            );

            if (MySqlDAO::executeQuery($query, $params)) {
                return true;
            }

        }
        return false;
    }
}