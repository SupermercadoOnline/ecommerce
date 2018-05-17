<html>
    <head>
    </head>
    <body>
    <h1>Novo Produto</h1>>
    </hr>

    <form name="dadosProduto" action="cadastrarProduto.php">
        <label>Nome: <input type='text' name='nomeProduto'></label><br/>
        <label>Categoria:</label>
        <select name="categoria">

            <option value="">Selecione</option>

            <?php
            $categoriasDAO = new CategoriasDAO();
            $produtoDAO->getAll();

            foreach ($produtoDAO as $produto){
                ?>
                <option value="<?php echo $produto.getId() ?>"> <?php echo $produto.getNome()?></option>
            <?php

            }
            ?>
        </select>

        <input type='submit' value='Cadastrar'/>
    </form>

    </body>
<?php
include_once "ProdutosBean.php";
include_once "ProdutosDAO.php";
include_once "CategoriasDAO.php";

?>
</html>