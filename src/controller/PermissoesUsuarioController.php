<?php
include_once ROOT_PATH . '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/PermissoesUsuario.php';
include_once ROOT_PATH . '/model/Pessoas.php';

class PermissoesUsuarioController
{
    public function getByPermissoes()
    {
        return $this->select("select * from permissoes_possiveis_usuario_admin order by nome");
    }

    public function getByNomePermissoes($nome)
    {
        return $this->select("select * from permissoes_possiveis_usuario_admin where nome like '$nome%' order by nome");
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new PermissoesUsuario($row['id'], $row['nome']);
        }

        return $lista;
    }

    public function salvar($pessoaBean, $id_permissao)
    {
        if ($pessoaBean instanceof Pessoas) {
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