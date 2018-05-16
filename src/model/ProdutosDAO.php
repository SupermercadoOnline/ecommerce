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

    protected function insert($produtosBean){

        if($produtosBean instanceof ProdutosBean){
            
            $query = $this->mysqli->prepare("INSERT INTO produtos (nome, id_categoria, preco, fabricante, descricao, estoque_minimo) VALUES (?, ?, ?, ?, ?, ?)");
            $query->bind_param('sidssi', $produtosBean->getNome(), $produtosBean->getIdCatergoria(), $produtosBean->getPreco(), $produtosBean->getFabricante(), $produtosBean->getDescricao(), $produtosBean->getEstoqueMinimo());
            if($query->execute()){
                $produtosBean->setId($query->insert_id);
                return $produtosBean;
            }

        }

        return false;

    }

    protected function update($produtosBean){

    }

    protected function salvar($produtosBean){
        // TODO: Implement salvar() method.
    }

    protected function delete($produtosBean){
        // TODO: Implement delete() method.
    }
}
