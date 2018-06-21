<?php
include_once ROOT_PATH . '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/EstoqueProdutos.php';
include_once 'ProdutosController.php';
include_once 'PessoasController.php';
include_once ROOT_PATH . '/functions.php';

class EstoqueProdutosController
{

    private $produtosDAO;

    public function __construct()
    {
        $this->produtosDAO = new ProdutosController();
    }


    public function entradaProduto($produtosBean, $quantidade, $dataBrMovimento = null){

        if($produtosBean instanceof Produtos && $quantidade > 0){

            $dataPhpMovimento = empty($dataBrMovimento) ? get_string_datetime_atual() : data_br_to_data_php($dataBrMovimento);
            return $this->insertMovimento($produtosBean, $quantidade, $dataPhpMovimento);

        }

        return false;

    }

    public function saidaProduto($produtosBean, $quantidade, $dataBrMovimento = null){

        if($produtosBean instanceof Produtos && $quantidade > 0){

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

    private function enviarEmailEstoqueCritico(Produtos $produtosBean){

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
        $pessoasDAO = new PessoasController();
        foreach($pessoasDAO->getByPermissoes($idPermissaoEditarEstoque) as $pessoasBean){
            if($pessoasBean instanceof Pessoas)
                envia_email($pessoasBean->getEmail(), 'Estoque crítico', $mensagem_estoque_critico);
        }

    }

    public function getQuantidadeEmEstoque($produtosBean){

        $quantidadeEstoque = 0;
        
        if($produtosBean instanceof Produtos){

            $query = "SELECT sum(quantidade) FROM estoque_produtos WHERE id_produto = ?";
            $parametros = array($produtosBean->getId());
            $result = MySqlDAO::getResult($query, $parametros)->fetch_row();
            $quantidadeEstoque = $result[0];
            if($quantidadeEstoque == null)
                $quantidadeEstoque = 0;

        }

        return $quantidadeEstoque;

    }

    private function insertMovimento($produtosBean, $quantidade, $dataPhpMovimento){

        if($produtosBean instanceof Produtos){

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