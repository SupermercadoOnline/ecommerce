<?php
include_once 'MySqlDAO.php';
include_once 'CidadesBean.php';

class CidadesDAO
{
    public function getAll()
    {
        return $this->select("select * from cidades order by nome");
    }

    public function getByEstado($id)
    {
        return $this->select("select * from cidades where id_estado = '$id' order by nome");
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new CidadesBean($row['id'], $row['id_estado'],
                $row['nome']);
        }

        return $lista;
    }
}