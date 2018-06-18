<?php
include_once dirname(__DIR__)."/configs.php";
include_once ROOT_PATH .  '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/ProdutosVenda.php';

class ProdutosVendaController{

    public function getByIdVenda($id){
        return $this->select("SELECT * FROM produtos_venda WHERE id_venda='$id'");
    }

    public function salvar($bean){

        if($bean instanceof ProdutosVenda){

            if(empty($this->getByIdVenda($bean->getIdVenda()))){
                return $this->insert($bean);

            } else {
                return $this->update($bean);
            }
        }
        return false;
    }

    private function select($query):array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);

        while($row = $result->fetch_array()){
            $lista[] = new ProdutosVenda($row['id_venda'], $row['id_produto'],
                $row['quantidade_produto'], $row['preco_produto_data_venda']);
        }

        return $lista;
    }

    private function insert($bean){

        if($bean instanceof ProdutosVenda){
            $query = "INSERT INTO produtos_venda (id_venda, id_produto, quantidade_produto, 
                      preco_produto_data_venda) VALUES (?,?,?,?)";

            $params = array(
                $bean->getIdVenda(),
                $bean->getIdProduto(),
                $bean->getQuantidadeProduto(),
                $bean->getPrecoProdutoDataVenda()
            );

            $result = MySqlDAO::executeQuery($query, $params);

            if($result != false){
                $bean->setIdVenda();
                return $bean;
            }
        }
        return false;
    }

    private function update($bean){
        if($bean instanceof ProdutosVenda){
            $query = "UPDATE produtos_venda SET id_produto=?, quantidade_produto=?, 
                      preco_produto_data_venda WHERE id_venda=?";

            $params = array(
                $bean->getIdProduto(),
                $bean->getQuantidadeProduto(),
                $bean->getPrecoProdutoDataVenda(),
                $bean->getIdVenda()
            );

            return MySqlDAO::executeQuery($query, $params);
        }
        return false;
    }
}