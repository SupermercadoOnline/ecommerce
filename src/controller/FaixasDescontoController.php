<?php
include_once ROOT_PATH .  '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/FaixasDesconto.php';

class PromocoesController
{

    public function getById($id)
    {
        return $this->select("select * from faixas_desconto_promocao where id = '$id'")[0];
    }

    public function getByPromocao($id)
    {
        return $this->select("select * from faixas_desconto_promocao where id_promocao = '$id'")[0];
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new FaixasDesconto($row['id'], $row['id_promocao'],
                $row['ate_preco_produto'], $row['percentual_desconto']);
        }

        return $lista;
    }

    private function insert($model)
    {
        if($model instanceof FaixasDesconto) {
            $query = "insert into faixas_desconto_promocao (id_promocao, ate_preco_produto, percentual_desconto)
                values (?, ?, ?)";

            $params = array(
                $model->getIdPromocao(),
                $model->getAtePrecoProduto(),
                $model->getPercentualDesconto()
            );

            $result = MySqlDAO::executeQuery($query, $params);

            if($result != false) {
                $model->setId($result);
                return $model;
            }
        }
        return false;
    }

    private function update($model)
    {
        if($model instanceof FaixasDesconto) {
            $query = "update faixas_desconto_promocao set ate_preco_produto = ?, percentual_desconto = ?
                where id = ?";

            $params = array(
                $model->getAtePrecoProduto(),
                $model->getPercentualDesconto(),
                $model->getId()
            );

            return MySqlDAO::executeQuery($query, $params);
        }
        return false;
    }

    public function salvar($model)
    {
        if($model instanceof FaixasDesconto) {
            if(!empty($this->getById($model->getId()))) {
                return $this->update($model);
            } else {
                return $this->insert($model);
            }

        }
        return false;
    }

}