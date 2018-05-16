<?php
include_once 'DAOInterface.php';
include_once 'ProdutoBean.php.php';

class ProdutoDAO extends DAOInterface{

    public function getAll(){
        return $this->select('SELECT * FROM produtos ORDER BY nome');
    }

    protected function select($query):array{
        $listaProdutos = array();
        $selectProdutos = $this->mysqli->query($query);

        while($row = $selectProdutos->fetch_array())
            $listaProdutos[] = new ProdutosBean($row['id'], $row['nome'], $row['id_categoria'], $row['preco'],
                $row['fabricante'], $row['descricao'], $row['is_ativo']);

        return $listaProdutos;
    }

    protected function insert($bean){
        return $sql = "INSERT INTO produtos (nome, id_categoria, preco, fabricante, descricao, is_ativo) VALUES
                       ('".$bean->getNome().", ".$bean->getIdCategoria().", ".$bean->getPreco().", ".$bean->getFabricante().",
                        ".$bean->getDescricao().", ".$bean->getIsAtivo()."')";
    }

    protected function update($bean){
        $bean->
    }

    protected function salvar($bean){
        // TODO: Implement salvar() method.
    }

    protected function delete($bean){
        // TODO: Implement delete() method.
    }
}
