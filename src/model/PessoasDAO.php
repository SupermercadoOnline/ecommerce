<?php
include_once 'DAOInterface.php';
include_once 'PessoasBean.php';

class PessoasDAO extends DAOInterface
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
        $select = $this->mysqli->query($query);
        while($row = $select->fetch_array()) {
            $listaDePessoas[] = new PessoasBean($row['id'], $row['nome'],
                $row['razaoSocial'], $row['cpf'], $row['cnpj'], $row['email'], $row['senha'],
                $row['isAtivo'], $row['isReceberAlertasPromocao']);
        }

        return $listaDePessoas;
    }

    protected function insert($bean)
    {
        if($bean instanceof PessoasBean) {
            $insert = $this->mysqli->prepare("insert into pessoas (nome, razao_social, cpf, 
                cnpj, email, senha, is_receber_alertas_promocao)
                values (?, ?, ?, ?, ?, ?, ?)");

            $insert->bind_param("ssssssi", $bean->getNome(),
                $bean->getRazaoSocial(), $bean->getCpf(), $bean->getCnpj(),
                $bean->getEmail(), $bean->getSenha(), $bean->getIsReceberAlertasPromocao());

            if($insert->execute()) {
                $bean->setId($insert->insert_id);
                return $bean;
            }
        }

        return false;
    }

    protected function update($bean)
    {
        if($bean instanceof PessoasBean) {
            $update = $this->mysqli->prepare("update pessoas set nome = ?, razao_social = ?,
                cpf = ?, cnpj = ?, email = ?, senha = ?, is_receber_alertas_promocao = ?
                where id = ?");

            $update->bind_param("ssssssii",$bean->getNome(), $bean->getRazaoSocial(),
                $bean->getCpf(), $bean->getCnpj(), $bean->getEmail(), $bean->getSenha(),
                $bean->getIsReceberAlertasPromocao(), $bean->getId());

            if($update->execute()) {
                return true;
            }

            return false;
        }
    }

    public function salvar($bean)
    {
        if($bean instanceof PessoasBean) {
            if($this->consultaPorId($bean->getId()) != null) {
                return $this->update($bean);
            } else {
                return $this->insert($bean);
            }

            return false;
        }
    }

    public function delete($bean)
    {
        if($bean instanceof PessoasBean) {
            $delete = $this->mysqli->prepare("update pessoas set is_ativo = ? where id = ?");

            $delete->bind_param("i",$bean->getIsAtivo(),$bean->getId());

            if($delete->execute()) {
                return true;
            }

            return false;
        }
    }
}