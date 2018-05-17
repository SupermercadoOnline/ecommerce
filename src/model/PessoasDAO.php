<?php
include_once 'MySqlDAO.php';
include_once 'PessoasBean.php';

class PessoasDAO
{

    public function consultaPorId($id)
    {
        return $this->select("select * from pessoas where id = '$id' order by nome");
    }

    public function consultarPorNome($nome)
    {
        return $this->select("select * from pessoas where nome = '$nome' order by nome");
    }

    protected function select($query): array
    {
        $listaDePessoas = array();
        $select = MySqlDAO::getResult($query);
        while($row = $select->fetch_array()) {
            $listaDePessoas[] = new PessoasBean($row['id'], $row['nome'],
                $row['razao_social'], $row['cpf'], $row['cnpj'], $row['email'], $row['senha'],
                $row['is_ativo'], $row['is_receber_alertas_promocao']);
        }

        return $listaDePessoas;
    }

    protected function insert($bean)
    {
        if($bean instanceof PessoasBean) {
            $query = "insert into pessoas (nome, razao_social, cpf, 
                cnpj, email, senha, is_receber_alertas_promocao)
                values (?, ?, ?, ?, ?, ?, ?)";

            $params = array(
                $bean->getNome(),
                $bean->getRazaoSocial(),
                $bean->getCpf(),
                $bean->getCnpj(),
                $bean->getEmail(),
                password_hash($bean->getSenha(), PASSWORD_DEFAULT),
                $bean->getIsReceberAlertasPromocao()
            );

            $result = MySqlDAO::executeQuery($query, $params);

            if($result != false) {
                $bean->setId($result);
                return $bean;
            }
        }
        return false;
    }

    protected function update($bean)
    {
        if($bean instanceof PessoasBean) {
            $query = "update pessoas set nome = ?, razao_social = ?,
                cpf = ?, cnpj = ?, email = ?, senha = ?, is_receber_alertas_promocao = ?
                where id = ?";

            $params = array(
                $bean->getNome(),
                $bean->getRazaoSocial(),
                $bean->getCpf(), $bean->getCnpj(),
                $bean->getEmail(),
                password_hash($bean->getSenha(), PASSWORD_DEFAULT),
                $bean->getIsReceberAlertasPromocao(),
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
        if($bean instanceof PessoasBean) {
            if($this->consultaPorId($bean->getId()) != null) {
                return $this->update($bean);
            } else {
                return $this->insert($bean);
            }

        }
            return false;
    }

    public function delete($bean)
    {
        if($bean instanceof PessoasBean) {
            $delete = $this->mysqli->prepare("update pessoas set is_ativo = ? where id = ?");

            $delete->bind_param("i",$bean->getIsAtivo(),$bean->getId());

            if($delete->execute()) {
                return true;
            }

        }
            return false;
    }
}