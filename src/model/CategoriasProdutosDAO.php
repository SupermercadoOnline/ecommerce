<?php
include_once "MySqlDAO.php";
include_once "CategoriasProdutosBean.php";

class CategoriasProdutosDAO
{


    public function getAll(){
        return $this->select('SELECT * FROM categoria_produtos ORDER BY id');
    }


    protected function select($query):array
    {
        $listaCategorias = array();
        $selectListas = MySqlDAO::getResult($query);
        while($row = $selectListas->fetch_array())
            $listaCategorias[] = new CategoriasProdutosBean($row['id'], $row['nome'], $row['is_ativo']);

        return $listaCategorias;
    }

    public function getProdutoPorId($id){
        $categoriaBean = null;
        $listaCategoria = $this->select("select * from categoria_produtos where id = '$id'");

        if(!empty($listaCategoria)){
            $categoriaBean = $listaCategoria[0];

            return $categoriaBean;
        }



    }

    protected function insert($categoriasBean)
    {
        $query = "INSERT INTO categoria_produtos (nome) values (?)";
        $parametros = array(

            $categoriasBean->getNome()


        );
        $result = MySqlDAO::executeQuery($query, $parametros);
        if($result != false){

            $categoriasBean->setId($result);
            return $categoriasBean;

        }



    }

    protected function update($categoriasBean)
    {


        if($categoriasBean instanceof CategoriasProdutosBean){

            $query = "UPDATE categoria_produtos SET id=?, nome=?, is_ativo=? WHERE id=?";
            $parametros = array(
                $categoriasBean->getNome(),
                $categoriasBean->getId(),
                $categoriasBean->getIsAtivo(),

            );

            if(MySqlDAO::executeQuery($query, $parametros)){
                return true;
            }
        }
        return false;
    }


    public function salvar($categoriasBean)
    {
        if($categoriasBean instanceof CategoriasProdutosBean){

            if(empty($categoriasBean->getId()))
                if($this->insert($categoriasBean))
                    return true;

            if($this->update($categoriasBean))
                return true;
        }

        return false;

    }

    public function delete($categoriasBean)
    {


        if($categoriasBean instanceof CategoriasProdutosBean){

            $categoriasBean->setIsAtivo(false);
            return $this->update($categoriasBean);

        }

        return false;

    }


}