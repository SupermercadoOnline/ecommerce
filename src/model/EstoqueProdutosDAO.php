<?php
include_once 'MySqlDAO.php';
include_once 'EstoqueProdutosBean.php';
include_once dirname(__DIR__) . '/functions.php';

class EstoqueProdutosDAO
{

    public function entradaProduto($produtosBean, $quantidade, $dataBrMovimento = null){

        if($produtosBean instanceof ProdutosBean && $quantidade > 0){

            $dataPhpMovimento = empty($dataBrMovimento) ? get_string_datetime_atual() : data_br_to_data_php($dataBrMovimento);
            return $this->insertMovimento($produtosBean, $quantidade, $dataPhpMovimento);

        }

        return false;

    }

    public function saidaProduto($produtosBean, $quantidade, $dataBrMovimento = null){

        if($produtosBean instanceof ProdutosBean && $quantidade > 0){

            $dataPhpMovimento = empty($dataBrMovimento) ? get_string_datetime_atual() : data_br_to_data_php($dataBrMovimento);
            return $this->insertMovimento($produtosBean, $quantidade * -1, $dataPhpMovimento);

        }

        return false;

    }

    public function getQuantidadeEmEstoque($produtosBean){

        $quantidadeEstoque = 0;
        
        if($produtosBean instanceof ProdutosBean){

            $query = "SELECT sum(quantidade) FROM estoque_produtos WHERE id_produto = ?";
            $parametros = array($produtosBean->getId());
            $result = MySqlDAO::getResult($query, $parametros)->fetch_row();
            $quantidadeEstoque = $result[0];

        }

        return $quantidadeEstoque;

    }

    private function insertMovimento($produtosBean, $quantidade, $dataPhpMovimento){

        if($produtosBean instanceof ProdutosBean){

            $query = "INSERT INTO estoque_produtos (id_produto, quantidade, data_movimento) VALUES (?, ?, ?)";
            $parametros = array(
                $produtosBean->getId(),
                $quantidade,
                $dataPhpMovimento
            );

            return MySqlDAO::executeQuery($query, $parametros) === true;

        }

        return false;

    }

}