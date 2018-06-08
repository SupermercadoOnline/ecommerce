<?php
include_once ROOT_PATH . '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/Cidades.php';

class CidadesController
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
            $lista[] = new Cidades($row['id'], $row['id_estado'],
                $row['nome']);
        }

        return $lista;
    }
}