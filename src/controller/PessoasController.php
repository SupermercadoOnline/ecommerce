<?php
include_once ROOT_PATH .  '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/Pessoas.php';

class PessoasController
{

    public function getById($id)
    {
        return $this->select("select * from pessoas where id = '$id'")[0];
    }

    public function getByNome($nome)
    {
        return $this->select("select * from pessoas where nome = '$nome' order by nome");
    }

    public function getByPermissoes($idPermissao)
    {
        return $this->select(
            "select
              pessoas.* 
            from 
              pessoas 
            inner join permissoes_usuario_admin on pessoas.id = permissoes_usuario_admin.id_pessoa 
            where 
              permissoes_usuario_admin.id_permissao = '$idPermissao'"
        );

    }

    public function getByEmail($email)
    {
        return $this->select("select * from pessoas where email = '$email'")[0];
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);
        while($row = $result->fetch_array()) {
            $lista[] = new Pessoas($row['id'], $row['nome'],
                $row['razao_social'], $row['cpf'], $row['cnpj'], $row['email'], $row['senha'],
                $row['is_ativo'], $row['is_receber_alertas_promocao']);
        }

        return $lista;
    }

    private function insert($bean)
    {
        if($bean instanceof Pessoas) {
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

    private function update($bean)
    {
        if($bean instanceof Pessoas) {
            $query = "update pessoas set nome = ?, razao_social = ?,
                cpf = ?, cnpj = ?, email = ?, senha = ?, is_ativo = ?, is_receber_alertas_promocao = ?
                where id = ?";

            $params = array(
                $bean->getNome(),
                $bean->getRazaoSocial(),
                $bean->getCpf(), $bean->getCnpj(),
                $bean->getEmail(),
                password_hash($bean->getSenha(), PASSWORD_DEFAULT),
                $bean->getIsAtivo(),
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
        if($bean instanceof Pessoas) {
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
        if($bean instanceof Pessoas) {

            $bean->setIsAtivo(false);
            return $this->update($bean);

        }
            return false;
    }
}