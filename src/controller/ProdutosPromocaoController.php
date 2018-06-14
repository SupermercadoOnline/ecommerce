<?php
include_once ROOT_PATH . '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/Promocoes.php';
include_once ROOT_PATH . '/model/Produtos.php';

class ProdutosPromocaoController
{
    public function salvar($promocao, $idProduto) {
        if($promocao instanceof Promocoes) {
            $query = "insert into produtos_promocao (id_promocao, id_produto) values (?, ?)";

            $params = array(
                $promocao->getId(),
                $idProduto
            );

            if(MySqlDAO::executeQuery($query, $params)) {
                return true;
            }
        }
        return false;

    }

}