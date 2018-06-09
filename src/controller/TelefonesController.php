<?php
include_once ROOT_PATH . '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/Telefones.php';

class TelefonesController
{
    public function getById($id)
    {
        return $this->select("select * from telefones where id = '$id'")[0];
    }

    public function getByPessoa($id)
    {
        return $this->select("select * from telefones where id_pessoa = '$id'")[0];
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new Telefones($row['id'], $row['id_pessoa'],
                $row['numero_telefone'], $row['is_ativo']);
        }

        return $lista;
    }

    private function insert($bean)
    {
        if($bean instanceof Telefones) {
            $query = "insert into telefones (id_pessoa, numero_telefone)
                values (?, ?)";

            $params = array(
                $bean->getIdPessoa(),
                $bean->getNumeroTelefone()
            );

            $result = MySqlDAO::executeQuery($query, $params);

            if($result != false) {
                $bean->setId($result);
                return $bean;
            }
        }
        return false;
    }

    private function update($bean)
    {
        if($bean instanceof Telefones) {
            $query = "update telefones set numero_telefone = ?, is_ativo = ? where id = ?";

            $params = array(
                $bean->getNumeroTelefone(),
                $bean->getisAtivo(),
                $bean->getId()
            );

            if(MySqlDAO::executeQuery($query, $params)) {
                return true;
            }
        }
        return false;
    }

    public function salvar($bean)
    {
        if($bean instanceof Telefones) {
            if($this->getById($bean->getId()) != null) {
                return $this->update($bean);
            } else {
                return $this->insert($bean);
            }

        }
        return false;
    }

    public function delete($bean)
    {
        if($bean instanceof Telefones) {

            $bean->setIsAtivo(false);
            return $this->update($bean);

        }
        return false;
    }
}