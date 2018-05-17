<?php
include_once 'MySqlDAO.php';
include_once 'ProdutosBean.php';

class ProdutosDAO{

    public function getAll(){
        return $this->select('SELECT * FROM produtos ORDER BY nome');
    }

    public function getProdutoPorId($id){

        $produtoBean = null;
        $listaProdutos = $this->select("SELECT * FROM produtos WHERE id = '$id'");
        if(!empty($listaProdutos))
            $produtoBean = $listaProdutos[0];

        return $produtoBean;

    }

    private function select($query):array{
        $listaProdutos = array();
        $selectProdutos = MySqlDAO::getResult($query);
        while($row = $selectProdutos->fetch_array())
            $listaProdutos[] = new ProdutosBean($row['id'], $row['nome'], $row['id_categoria'], $row['preco'],
                $row['fabricante'], $row['descricao'], $row['estoque_minimo'], $row['is_ativo']);

        return $listaProdutos;
    }

    private function insert($produtosBean){

        if($produtosBean instanceof ProdutosBean){
            
            $query = "INSERT INTO produtos (nome, id_categoria, preco, fabricante, descricao, estoque_minimo) VALUES (?, ?, ?, ?, ?, ?)";
            $parametros = array(
                $produtosBean->getNome(),
                $produtosBean->getIdCatergoria(),
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

        if($produtosBean instanceof ProdutosBean){

            $query = "UPDATE produtos SET nome=?, id_categoria=?, preco=?, fabricante=?, descricao=?, estoque_minimo=?, is_ativo=? WHERE id=?";
            $parametros = array(
                $produtosBean->getNome(),
                $produtosBean->getIdCatergoria(),
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

    public function salvar($produtosBean){

        if($produtosBean instanceof ProdutosBean){

            if(empty($this->getProdutoPorId($produtosBean->getId())))
                if($this->insert($produtosBean))
                    return true;
            else
                if($this->update($produtosBean))
                    return true;

        }

        return false;
    }

    public function delete($produtosBean){

        if($produtosBean instanceof ProdutosBean){

            $produtosBean->setIsAtivo(false);
            return $this->update($produtosBean);

        }

        return false;
    }
}
