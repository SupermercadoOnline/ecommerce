<?php
include_once 'MySqlDAO.php';
include_once 'EstoqueProdutosBean.php';
include_once 'ProdutosDAO.php';
include_once 'PessoasDAO.php';
include_once dirname(__DIR__) . '/functions.php';

class EstoqueProdutosDAO
{

    private $produtosDAO;

    public function __construct()
    {
        $this->produtosDAO = new ProdutosDAO();
    }


    public function entradaProduto($produtosBean, $quantidade, $dataBrMovimento = null){

        if($produtosBean instanceof ProdutosBean && $quantidade > 0){

            $dataPhpMovimento = empty($dataBrMovimento) ? get_string_datetime_atual() : data_br_to_data_php($dataBrMovimento);
            return $this->insertMovimento($produtosBean, $quantidade, $dataPhpMovimento);

        }

        return false;

    }

    public function saidaProduto($produtosBean, $quantidade, $dataBrMovimento = null){

        if($produtosBean instanceof ProdutosBean && $quantidade > 0){

            if($this->getQuantidadeEmEstoque($produtosBean) >= $quantidade){

                $dataPhpMovimento = empty($dataBrMovimento) ? get_string_datetime_atual() : data_br_to_data_php($dataBrMovimento);
                if($this->insertMovimento($produtosBean, $quantidade * -1, $dataPhpMovimento)){

                    if($this->getQuantidadeEmEstoque($produtosBean) <= $produtosBean->getEstoqueMinimo())
                        $this->enviarEmailEstoqueCritico($produtosBean);

                }

            }

        }

        return false;

    }

    private function enviarEmailEstoqueCritico(ProdutosBean $produtosBean){

        $mensagem_estoque_critico =
            '<html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                </head>
                <body>
                    <h2>Produto: <b>' . $produtosBean->getNome() . '</b></h2>
                    <p>Somente <b>' . $this->getQuantidadeEmEstoque($produtosBean) . '</b> unidade(s) em estoque!</p>
                </body>
            </html>';

        $idPermissaoEditarEstoque = 9;
        $pessoasDAO = new PessoasDAO();
        foreach($pessoasDAO->consultarPorPermissao($idPermissaoEditarEstoque) as $pessoasBean){
            if($pessoasBean instanceof PessoasBean)
                envia_email($pessoasBean->getEmail(), 'Estoque crítico', $mensagem_estoque_critico);
        }

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