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

    public function getByPessoa($id)
    {
        return $this->select("select *
        from permissoes_possiveis_usuario_admin 
        inner join permissoes_usuario_admin on permissoes_possiveis_usuario_admin.id = permissoes_usuario_admin.id_permissao
        where permissoes_usuario_admin.id_pessoa = '$id' order by nome");
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

    public function salvar($pessoa, $idPermissao)
    {
        if ($pessoa instanceof Pessoas) {
            $query = "INSERT INTO permissoes_usuario_admin (id_pessoa, id_permissao) VALUES (?, ?)";

            $params = array(
                $pessoa->getId(),
                $idPermissao
            );

            return MySqlDAO::executeQuery($query, $params);
        }
        return false;
    }

    public function delete($idPessoa)
    {
        $query = "delete from permissoes_usuario_admin where id_pessoa = ?";

        return MySqlDAO::executeQuery($query, array($idPessoa));
    }
}