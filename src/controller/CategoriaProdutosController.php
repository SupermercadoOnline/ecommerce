<?php
include_once dirname(__DIR__)."/configs.php";
include_once ROOT_PATH . '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/CategoriaProdutos.php';

class CategoriaProdutosController
{


    public function getAll(){
        return $this->select('SELECT * FROM categoria_produtos ORDER BY id');
    }

    public function retornePorStatus($status){
        return $this->select("SELECT * FROM categoria_produtos WHERE is_ativo = '$status'");
    }

    protected function select($query):array
    {
        $listaCategorias = array();
        $selectListas = MySqlDAO::getResult($query);
        while($row = $selectListas->fetch_array())
            $listaCategorias[] = new CategoriaProdutos($row['id'], $row['nome'], $row['is_ativo']);

        return $listaCategorias;
    }

    public function getById($id){
        $categoriaBean = null;
        if(!empty($id)){
            $listaCategoria = $this->select("select * from categoria_produtos where id = '$id'");
            if(!empty($listaCategoria)){
                $categoriaBean = $listaCategoria[0];
            }
        }
        return $categoriaBean;
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

    protected function update($categoriasBean){


        if($categoriasBean instanceof CategoriaProdutos){

            $query = "UPDATE categoria_produtos SET nome=?, is_ativo=? WHERE id=?";
            $parametros = array(
                $categoriasBean->getNome(),
                $categoriasBean->getIsAtivo(),
                $categoriasBean->getId()

            );

            if(MySqlDAO::executeQuery($query, $parametros)){
                return true;
            }
        }
        return false;
    }


    public function salvar($categoriasBean)
    {
        if($categoriasBean instanceof CategoriaProdutos){

            if(empty($categoriasBean->getId()))
                if($this->insert($categoriasBean))
                    return true;

            if($this->update($categoriasBean))
                return true;
        }

        return false;

    }

    public function delete($categorias){

        if($categorias instanceof CategoriaProdutos){

            $categorias->setIsAtivo(false);
            return $this->update($categorias);
        }

        return false;
    }
}