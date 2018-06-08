<?php
include_once ROOT_PATH . '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/Enderecos.php';

class EnderecosController
{
    public function getById($id)
    {
        return $this->select("select * from enderecos where id = '$id'")[0];
    }

    public function getByPessoa($id)
    {
        return $this->select("select * from enderecos where id_pessoa = '$id' order by rua");
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new Enderecos($row['id'], $row['id_pessoa'],
                $row['id_cidade'], $row['rua'], $row['bairro'], $row['numero'], $row['cep'],
                $row['complemento'], $row['is_ativo']);
        }

        return $lista;
    }

    private function insert($bean)
    {
        if($bean instanceof Enderecos) {
            $query = "insert into enderecos (id_pessoa, id_cidade, rua, 
                bairro, numero, cep, complemento)
                values (?, ?, ?, ?, ?, ?, ?)";

            $params = array(
                $bean->getIdPessoa(),
                $bean->getIdCidade(),
                $bean->getRua(),
                $bean->getBairro(),
                $bean->getNumero(),
                $bean->getCep(),
                $bean->getComplemento()
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
        if($bean instanceof Enderecos) {
            $query = "update enderecos set id_cidade = ?, rua = ?, 
                bairro = ?, numero = ?, cep = ?, complemento = ?, is_ativo = ? where id = ?";

            $params = array(
                $bean->getIdCidade(),
                $bean->getRua(),
                $bean->getBairro(),
                $bean->getNumero(),
                $bean->getCep(),
                $bean->getComplemento(),
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
        if($bean instanceof Enderecos) {
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
        if($bean instanceof Enderecos) {

            $bean->setIsAtivo(false);
            return $this->update($bean);

        }
        return false;
    }
}