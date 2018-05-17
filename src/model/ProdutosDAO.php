<?php
include_once 'DAOInterface.php';
include_once 'ProdutosBean.php';

class ProdutosDAO extends DAOInterface{

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

    protected function select($query):array{
        $listaProdutos = array();
        $selectProdutos = $this->mysqli->query($query);

        while($row = $selectProdutos->fetch_array())
            $listaProdutos[] = new ProdutosBean($row['id'], $row['nome'], $row['id_categoria'], $row['preco'],
                $row['fabricante'], $row['descricao'], $row['estoque_minimo'], $row['is_ativo']);

        return $listaProdutos;
    }

    protected function insert($produtosBean){

        if($produtosBean instanceof ProdutosBean){
            
            $query = $this->mysqli->prepare("INSERT INTO produtos (nome, id_categoria, preco, fabricante, descricao,
                                      estoque_minimo) VALUES (?, ?, ?, ?, ?, ?)");
            $query->bind_param('sidssi', $produtosBean->getNome(), $produtosBean->getIdCatergoria(),
                $produtosBean->getPreco(), $produtosBean->getFabricante(), $produtosBean->getDescricao(),
                $produtosBean->getEstoqueMinimo());

            if($query->execute()){
                $produtosBean->setId($query->insert_id);
                return true;
            }
        }
        return false;
    }

    public function update($produtosBean){

        if($produtosBean instanceof ProdutosBean){

            $query = $this->mysqli->prepare("UPDATE produtos SET nome=?, id_categoria=?, preco=?, fabricante=?, 
                                    descricao=?, estoque_minimo=?, is_ativo=? WHERE id=?");
            $query->bind_param('sidssibi', $produtosBean->getNome(), $produtosBean->getIdCatergoria(),
                $produtosBean->getPreco(), $produtosBean->getFabricante(), $produtosBean->getDescricao(),
                $produtosBean->getEstoqueMinimo(), $produtosBean->getIsAtivo(),$produtosBean->getId());

            if($query->execute()){
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

            $query = $this->mysqli->prepare("DELETE FROM produtos WHERE id=?");
            $query->bind_param('i', $produtosBean->getId());

            if($query->execute()){
                return true;
            }
        }

        return false;
    }
}
