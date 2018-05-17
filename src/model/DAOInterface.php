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

    abstract protected function select($query):array ;
    abstract protected function insert($bean);
    abstract protected function update($bean);
    abstract public function salvar($bean);
    abstract public function delete($bean);

    public function __destruct()
    {
        if($this->mysqli instanceof mysqli)
            $this->mysqli->close();
    }

}