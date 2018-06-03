<?php
include_once 'MySqlDAO.php';
include_once 'TiposPermissoesBean.php';
include_once 'PessoasBean.php';

class TiposPermissoesDAO
{
    public function getByPermissoes()
    {
        return $this->select("select * from permissoes_possiveis_usuario_admin order by nome");
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new TiposPermissoesBean($row['id'], $row['nome']);
        }

        return $lista;
    }

    public function salvar($pessoaBean, $id_permissao)
    {
        if ($pessoaBean instanceof PessoasBean) {
            $query = "INSERT INTO permissoes_usuario_admin (id_pessoa, id_permissao) VALUES (?, ?)";

            $params = array(
                $pessoaBean->getId(),
                $id_permissao
            );

            if (MySqlDAO::executeQuery($query, $params)) {
                return true;
            }

        }
        return false;
    }
}