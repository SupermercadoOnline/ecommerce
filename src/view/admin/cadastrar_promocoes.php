<?php
session_start();
include_once '../../functions.php';

if(possui_permissao($_SESSION['login']['id_pessoa'], 26)) {

    include_once 'header.php';
    include_once ROOT_PATH . '/controller/PromocoesController.php';
    include_once ROOT_PATH . '/controller/ProdutosController.php';
    include_once ROOT_PATH . '/controller/FaixasDescontoController.php';
    include_once ROOT_PATH . '/controller/ProdutosPromocaoController.php';

    $promocoesController = new PromocoesController();
    $faixasDescontoController = new FaixasDescontoController();
    $produtosPromocaoController = new ProdutosPromocaoController();
    if ($_POST["salvar"]) {
        $promocao = new Promocoes(null,
            $_POST['descricao'],
            $_POST['dataInicio'],
            $_POST['dataFim'],
            get_string_datetime_atual(),
            null);

        $promocao = $promocoesController->salvar($promocao);

        foreach ($_POST['atePrecoProduto'] as $atePrecoProduto) {
            foreach ($_POST['percentualDesconto'] as $percentualDesconto) {

                $faixasDescontoController->salvar(new FaixasDesconto(null,
                    $promocao->getId(),
                    $atePrecoProduto,
                    $percentualDesconto));

                $key = array_search($percentualDesconto, $_POST['percentualDesconto']);
                unset($_POST['percentualDesconto'][$key]);
                break;
            }
        }

        foreach ($_POST['produtosSelecionados'] as $produtoSelecionado) {
            $produtosPromocaoController->salvar($promocao, $produtoSelecionado);
        }
    }
    ?>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Nova promoção</b>
            </h3>
        </div>

        <div class="panel-body">

            <form action="<?php echo URL_HOST ?>/admin/form_cadastrar_promocoes.php" method="post" id="formPromocoes">

                <div class="row">

                    <div class="col-lg-4">

                        <label for="descricao">Descrição:</label>
                        <textarea rows="3" id="descricao" name="descricao" type="text" class="form-control input-lg"></textarea>

                    </div>

                    <div class="col-lg-4">

                        <label for="dataInicio">Data de início: </label>
                        <div class="input-group date data_formato" data-date-format="dd/mm/yyyy HH:ii:ss">
                            <input class="form-control" type="text" name="dataInicio">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </span>
                        </div>

                    </div>

                    <div class="col-lg-4">

                        <label for="dataFim">Data de encerramento: </label>
                        <div class="input-group date data_formato" data-date-format="dd/mm/yyyy HH:ii:ss">
                            <input class="form-control" type="text" name="dataFim">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </span>
                        </div>

                    </div>

                </div>

                <hr/>

                <div class="row">
                    <h4 style="padding-left: 15px"><b>Faixa de desconto</b></h4><br/>

                    <div class="col-lg-4">

                        <label for="atePrecoProduto[]">Preço do produto:</label>
                        <input id="atePrecoProduto" name="atePrecoProduto[]" type="text" class="form-control input-lg">

                    </div>

                    <div class="col-lg-4">

                        <label for="percentualDesconto[]">Percentual de desconto:</label>
                        <input id="percentualDesconto" name="percentualDesconto[]" type="text" class="form-control input-lg">

                    </div>

                </div>

                <div id="adicionarFaixaDesconto"></div>

                <div class="row">

                    <div class="col-lg-4">

                        <br/>
                        <button onclick="adicionar()" type="button" class="btn btn-lg btn-default">Adicionar</button>

                    </div>

                </div>

                <hr/>

                <div class="row">
                    <h4 style="padding-left: 15px"><b>Produtos participantes</b></h4><br/>

                    <div class="col-lg-4">
                        <label for="produtos">Produtos: </label>
                        <select id="produtos" name="produtos" class="form-control input-lg" onchange="consultar('#listaProdutos', 'produtos', 'getListProdutos', this.value)">
                            <?php
                            $produtosController = new ProdutosController();
                            foreach ($produtosController->getAll() as $produto) {
                                echo "<option value='" . $produto->getId() . "'> " . $produto->getNome() . "</option>";
                            }
                            ?>
                        </select>

                    </div>

                </div>

                <br/>
                <div class="row">

                    <div class="col-lg-4" id="adicionarListaProdutos">
                        <ul id="listaProdutos" class="list-group" style="list-style-type: none"></ul>
                    </div>

                </div>

                <hr/>
                <input type="submit" class="btn btn-default btn-lg center-block" name="salvar" value="Salvar">

            </form>

        </div>

    </div>

    <script>
        function adicionar() {
            $('#adicionarFaixaDesconto').append('<div class="row">\n' +
                '\n' +
                '                        <div class="col-lg-4">\n' +
                '\n' +
                '                            <label for="atePrecoProduto[]">Preço do produto:</label>\n' +
                '                            <input id="atePrecoProduto" name="atePrecoProduto[]" type="text" class="form-control input-lg">\n' +
                '\n' +
                '                        </div>\n' +
                '\n' +
                '                        <div class="col-lg-4">\n' +
                '\n' +
                '                            <label for="percentualDesconto[]">Percentual de desconto:</label>\n' +
                '                            <input id="percentualDesconto" name="percentualDesconto[]" type="text" class="form-control input-lg">\n' +
                '\n' +
                '                        </div>\n' +
                '\n' +
                '                    </div>');
        }

        var i =0;
        function consultar(element, controller, method, data) {
            if(i == 0) {
                $('#adicionarListaProdutos').prepend('<label>Produtos selecionados: </label>');
                i++;
            }
            $.ajax({
                type: "POST",
                url: "../call_webservice.php?request=get",
                data: "controller=" + controller + "&method=" + method + "&data=" + data,
                success: function (response) {
                    $(element).append(response);
                }
            });
        }
    </script>

    <?php

    include_once 'footer.php';
    ?>

    <script type="text/javascript">
        $('.data_formato').datetimepicker({
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            language: 'pt-BR',
            startDate: '+0d'
        });
    </script>

<?php
} else {
    echo 'Um erro aconteceu, por favor revise suas credenciais.';
}

