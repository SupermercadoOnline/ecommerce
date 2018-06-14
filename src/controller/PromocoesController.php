<?php
include_once ROOT_PATH .  '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/Promocoes.php';
include_once ROOT_PATH . '/functions.php';

class PromocoesController
{

    public function getById($id)
    {
        return $this->select("select * from promocoes where id = '$id'")[0];
    }

    public function getAll()
    {
        return $this->select("select * from promocoes order by data_cadastro");
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new Promocoes($row['id'], $row['descricao'],
                data_php_to_data_br((string) $row['data_inicio']),
                data_php_to_data_br((string) $row['data_fim']),
                data_php_to_data_br((string) $row['data_cadastro']),
                $row['is_ativa']);
        }

        return $lista;
    }

    private function insert($model)
    {
        if($model instanceof Promocoes) {
            $query = "insert into promocoes (descricao, data_inicio, data_fim, data_cadastro)
                values (?, ?, ?, ?)";

            $params = array(
                $model->getDescricao(),
                data_br_to_data_php((string) $model->getDataInicio()),
                data_br_to_data_php((string) $model->getDataFim()),
                $model->getDataCadastro()
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
        if($model instanceof Promocoes) {
            $query = "update promocoes set descricao = ?, data_inicio = ?,
                data_fim = ?, is_ativa = ?
                where id = ?";

            $params = array(
                $model->getDescricao(),
                data_br_to_data_php((string) $model->getDataInicio()),
                data_br_to_data_php((string) $model->getDataFim()),
                $model->getIsAtiva(),
                $model->getId()
            );

            return MySqlDAO::executeQuery($query, $params);
        }
        return false;
    }

    public function salvar($model)
    {
        if($model instanceof Promocoes) {
            if(!empty($this->getById($model->getId()))) {
                return $this->update($model);
            } else {
                return $this->insert($model);
            }

        }
        return false;
    }

    public function inativar($model)
    {
        if($model instanceof Promocoes) {
            $model->setIsAtivo(false);

            return $this->update($model);
        }
        return false;
    }

    public function ativar($model)
    {
        if($model instanceof Promocoes) {
            $model->setIsAtivo(true);

            return $this->update($model);
        }
        return false;
    }
}