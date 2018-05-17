<?php
include_once 'DAOInterface.php';
include_once 'ProdutosBean.php';

class ProdutosDAO extends DAOInterface{

    public function getAll(){
        return $this->select('SELECT * FROM produtos ORDER BY nome');
    }

    protected function select($query):array{
        $listaProdutos = array();
        $selectProdutos = $this->mysqli->query($query);

        while($row = $selectProdutos->fetch_array())
            $listaProdutos[] = new ProdutosBean($row['id'], $row['nome'], $row['id_categoria'], $row['preco'],
                $row['fabricante'], $row['descricao'], $row['estoque_minimo'], $row['is_ativo']);

        return $listaProdutos;
    }

    public function retornaProdutoBean($produtoBean):ProdutosBean{

        if($produtoBean instanceof ProdutosBean){
            $id = $produtoBean->getId();
            $produto = $this->mysqli->query("SELECT FROM produtos WHERE id=$id");
        }
        return $produto;
    }

    protected function insert($produtosBean){

        if($produtosBean instanceof ProdutosBean){
            
            $query = $this->mysqli->prepare("INSERT INTO produtos (nome, id_categoria, preco, fabricante, descricao,
                                      estoque_minimo, is_ativo) VALUES (?, ?, ?, ?, ?, ?)");
            $query->bind_param('sidssib', $produtosBean->getNome(), $produtosBean->getIdCatergoria(),
                $produtosBean->getPreco(), $produtosBean->getFabricante(), $produtosBean->getDescricao(),
                $produtosBean->getEstoqueMinimo(), $produtosBean->getIsAtivo());

            if($query->execute()){
                $produtosBean->setId($query->insert_id);
                return true;
            }
        }
        return false;
    }

    protected function update($produtosBean){

        if($produtosBean instanceof ProdutosBean){

            $query = $this->mysqli->prepare("UPDATE produtos SET nome=?, id_categoria=?, preco=?, fabricante=?, 
                                    descricao=?, estoque_minimo=?, is_ativo=? WHERE id=?)");
            $query->bind_param('sidssibi', $produtosBean->getNome(), $produtosBean->getIdCatergoria(),
                $produtosBean->getPreco(), $produtosBean->getFabricante(), $produtosBean->getDescricao(),
                $produtosBean->getEstoqueMinimo(), $produtosBean->getIsAtivo(),$produtosBean->getId());

            if($query->execute()){
                return true;
            }
        }
        return false;
    }

    protected function salvar($produtosBean){

        if($produtosBean instanceof ProdutosBean){
            $id = $produtosBean->getId();

            if($this->select("SELECT FROM produtos WHERE id=$id") > 0){
                $this->update($produtosBean);
                return true;

            } else {
                return true;
            }
        }

        return false;
    }

    protected function delete($produtosBean){

        if($produtosBean instanceof ProdutosBean){

            $query = $this->mysqli->prepare("DELETE FROM produtos WHERE id=?)");
            $query->bind_param('i', $produtosBean->getId());

            if($query->execute()){
                return true;
            }
        }

        return false;
    }
}
