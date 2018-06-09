<?php
include_once ROOT_PATH . '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/Estados.php';

class EstadosController
{

    public function getAll(){
        return $this->select('SELECT * FROM estados ORDER BY nome');
    }

    public function getById($id)
    {
        return $this->select("SELECT * FROM estados WHERE id = '$id'")[0];
    }

    protected function select($query):array
    {
        $listaEstados = array();
        $selectEstados = MySqlDAO::getResult($query);
        while($row = $selectEstados->fetch_array())
            $listaEstados[] = new Estados($row['id'], $row['nome'], $row['sigla']);

        return $listaEstados;
    }
}