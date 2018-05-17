<?php
include_once 'DAOInterface.php';
include_once 'EstadosBean.php';

class EstadosDAO extends DAOInterface
{

    public function getAll(){
        return $this->select('SELECT * FROM estados ORDER BY nome');
    }

    protected function select($query):array
    {
        $listaEstados = array();
        $selectEstados = $this->mysqli->query($query);
        while($row = $selectEstados->fetch_array())
            $listaEstados[] = new EstadosBean($row['id'], $row['nome'], $row['sigla']);

        return $listaEstados;
    }


    protected function insert($bean)
    {
        // TODO: Implement insert() method.
    }

    protected function update($bean)
    {
        // TODO: Implement update() method.
    }

    public function salvar($bean)
    {
        // TODO: Implement salvar() method.
    }

    public function delete($bean)
    {
        // TODO: Implement delete() method.
    }

}