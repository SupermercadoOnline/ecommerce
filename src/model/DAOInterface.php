<?php
include_once 'MySqlDAO.php';

abstract class DAOInterface
{

    protected $mysqli;

    /**
     * DAOInterface constructor.
     */
    public function __construct()
    {
        $this->mysqli = MySqlDAO::getInstance();
    }

    protected abstract function select($query):array ;
    protected abstract function insert($bean);
    protected abstract function update($bean);
    protected abstract function salvar($bean);
    protected abstract function delete($bean);

    public function __destruct()
    {
        if($this->mysqli instanceof mysqli)
            $this->mysqli->close();
    }

}