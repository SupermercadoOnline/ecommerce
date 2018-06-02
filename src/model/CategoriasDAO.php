<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 17/05/2018
 * Time: 10:51
 */

class CategoriasDAO
{


    public function getAll(){
        return $this->select('SELECT * FROM categoria_produtos ORDER BY id');
    }


    protected function select($query):array
    {
        $listaCategorias = array();
        $selectListas = MySqlDAO::getResult($query);
        while($row = $selectListas->fetch_array())
            $listaCategorias[] = new CategoriasBean($row['id'], $row['nome'], $row['is_ativo']);

        return $listaCategorias;
    }


    protected function insert($categoriasBean)
    {
        $query = "INSERT INTO categoria_produtos (id, nome, is_ativo) values (?,?,?)";
        $parametros = array(
            $categoriasBean->getId(),
            $categoriasBean->getNome(),
            $categoriasBean->getIsAtivo()

        );
        $result = MySqlDAO::executeQuery($query, $parametros);
        if($result != false){

            $categoriasBean->setId($result);
            return $categoriasBean;

        }



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