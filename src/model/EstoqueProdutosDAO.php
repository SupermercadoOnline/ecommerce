<?php
include_once 'MySqlDAO.php';
include_once 'EstoqueProdutosBean.php';
include_once dirname(__DIR__) . '/functions.php';

class EstoqueProdutosDAO
{

    public function entradaProduto($produtoBean, $quantidade, $dataBrMovimento = null){

        if($produtoBean instanceof ProdutosBean && $quantidade > 0){

            $dataPhpMovimento = empty($dataBrMovimento) ? get_string_datetime_atual() : data_br_to_data_php($dataBrMovimento);
            return $this->insertMovimento($produtoBean, $quantidade, $dataPhpMovimento);

        }

        return false;

    }

    public function saidaProduto($produtoBean, $quantidade, $dataBrMovimento = null){

        if($produtoBean instanceof ProdutosBean && $quantidade > 0){

            $dataPhpMovimento = empty($dataBrMovimento) ? get_string_datetime_atual() : data_br_to_data_php($dataBrMovimento);
            return $this->insertMovimento($produtoBean, $quantidade * -1, $dataPhpMovimento);

        }

        return false;

    }

    private function insertMovimento($produtoBean, $quantidade, $dataPhpMovimento){

        if($produtoBean instanceof ProdutosBean){

            $query = "INSERT INTO estoque_produtos (id_produto, quantidade, data_movimento) VALUES (?, ?, ?)";
            $parametros = array(
                $produtoBean->getId(),
                $quantidade,
                data_br_to_data_php($dataPhpMovimento)
            );

            return MySqlDAO::executeQuery($query, $parametros) != false;

        }

        return false;

    }

}