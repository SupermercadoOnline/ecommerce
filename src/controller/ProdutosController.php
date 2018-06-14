<?php
include_once dirname(__DIR__)."/configs.php";
include_once ROOT_PATH . '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/Produtos.php';

class ProdutosController
{
    public function getAll(){
        return $this->select('SELECT * FROM produtos ORDER BY nome');
    }

    public function retornePorStatus($status){
        return $this->select("SELECT * FROM produtos WHERE is_ativo = '$status'");
    }

    public function getById($id){

        $produtoBean = null;
        if(!empty($id)){
            $listaProdutos = $this->select("SELECT * FROM produtos WHERE id = '$id'");
            if(!empty($listaProdutos))
                $produtoBean = $listaProdutos[0];
        }

        return $produtoBean;

    }

    private function select($query):array{
        $listaProdutos = array();
        $selectProdutos = MySqlDAO::getResult($query);
        while($row = $selectProdutos->fetch_array())
            $listaProdutos[] = new Produtos($row['id'], $row['nome'], $row['id_categoria'], $row['preco'],
                $row['fabricante'], $row['descricao'], $row['estoque_minimo'], $row['is_ativo']);

        return $listaProdutos;
    }

    private function insert($produtosBean){

        if($produtosBean instanceof Produtos){
            
            $query = "INSERT INTO produtos (nome, id_categoria, preco, fabricante, descricao, estoque_minimo) VALUES (?, ?, ?, ?, ?, ?)";
            $parametros = array(
                $produtosBean->getNome(),
                $produtosBean->getIdCategoria(),
                $produtosBean->getPreco(),
                $produtosBean->getFabricante(),
                $produtosBean->getDescricao(),
                $produtosBean->getEstoqueMinimo()
            );
            $result = MySqlDAO::executeQuery($query, $parametros);
            if($result != false){

                $produtosBean->setId($result);
                return $produtosBean;

            }

        }
        return false;
    }

    private function update($produtosBean){

        if($produtosBean instanceof Produtos){

            $query = "UPDATE produtos SET nome=?, id_categoria=?, preco=?, fabricante=?, descricao=?, estoque_minimo=?, is_ativo=? WHERE id=?";
            $parametros = array(
                $produtosBean->getNome(),
                $produtosBean->getIdCategoria(),
                $produtosBean->getPreco(),
                $produtosBean->getFabricante(),
                $produtosBean->getDescricao(),
                $produtosBean->getEstoqueMinimo(),
                $produtosBean->getIsAtivo(),
                $produtosBean->getId()
            );

            if(MySqlDAO::executeQuery($query, $parametros)){
                return true;
            }
        }
        return false;
    }

    public function salvar($bean){

        if($bean instanceof Produtos){

            if(empty($this->getById($bean->getId()))){
                return $this->insert($bean);
            } else {
                return $this->update($bean);
            }
        }

        return false;
    }

    public function delete($produtosBean){

        if($produtosBean instanceof Produtos){

            $produtosBean->setIsAtivo(false);
            return $this->update($produtosBean);

        }

        return false;
    }

    public function ativar($produtosBean){

        if($produtosBean instanceof Produtos){

            $produtosBean->setIsAtivo(true);
            return $this->update($produtosBean);

        }

        return false;
    }
}
