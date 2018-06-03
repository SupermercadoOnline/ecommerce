<?php
include_once 'MySqlDAO.php';
include_once 'TiposPessoasBean.php';
include_once 'PessoasBean.php';

class TiposPessoasDAO
{
    public function consultaPorId($id)
    {
        return $this->select("select * from tipos_possiveis_pessoa where id = '$id' order by nome")[0];
    }

    public function consultarTudo()
    {
        return $this->select("select * from tipos_possiveis_pessoa order by nome");
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new TiposPessoasBean($row['id'], $row['nome']);
        }

        return $lista;
    }

    public function salvar($pessoaBean, $tipoPessoaBean)
    {
        if ($pessoaBean instanceof PessoasBean && $tipoPessoaBean instanceof TiposPessoasBean) {
            $query = "INSERT INTO tipo_pessoa (id_pessoa, id_tipo) VALUES (?, ?)";

            $params = array(
                $pessoaBean->getId(),
                $tipoPessoaBean->getId()
            );

            if (MySqlDAO::executeQuery($query, $params)) {
                return true;
            }

        }
        return false;
    }
}