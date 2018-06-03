<?php
include_once 'MySqlDAO.php';
include_once 'TelefonesBean.php';
include_once 'PessoasBean.php';

class TelefonesDAO
{
    public function getById($id)
    {
        return $this->select("select * from telefones where id = $id")[0];
    }

    public function getByPessoa($id)
    {
        return $this->select("select * from telefones where id_pessoa = $id order by numero_telefone");
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new TelefonesBean($row['id'], $row['id_pessoa'],
                $row['numero_telefone'], $row['is_ativo']);
        }

        return $lista;
    }

    private function insert($bean)
    {
        if($bean instanceof TelefonesBean) {
            $query = "insert into telefones (id, id_pessoa, numero_telefone, is_ativo)
                values (?, ?, ?, ?)";

            $params = array(
                $bean->getId(),
                $bean->getIdPessoa(),
                $bean->getNumeroTelefone(),
                $bean->getisAtivo(),
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
        if($bean instanceof TelefonesBean) {
            $query = "update telefones set numero_telefone = ?, is_ativo = ? where id_pessoa = ?";

            $params = array(
                $bean->getNumeroTelefone(),
                $bean->getisAtivo(),
                $bean->getIdPessoa()
            );

            if(MySqlDAO::executeQuery($query, $params)) {
                return true;
            }
        }
        return false;
    }

    public function salvar($bean)
    {
        if($bean instanceof TelefonesBean) {
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
        if($bean instanceof TelefonesBean) {

            $bean->setIsAtivo(false);
            return $this->update($bean);

        }
        return false;
    }
}