<?php
include_once dirname(__DIR__)."/configs.php";
include_once ROOT_PATH .  '/model/MySqlDAO.php';
include_once ROOT_PATH . '/model/Vendas.php';


class VendasController{

    public function getById($id){
        return $this->select("SELECT * FROM vendas WHERE id='$id'")[0];
    }

    public function getAll(){
        return $this->select("SELECT * FROM vendas");
    }

    public function retornePorPessoa($id){
        return $this->select("SELECT * FROM vendas WHERE id_pessoa='$id' ORDER BY data_venda DESC");
    }

    public function salvar($bean){

        if($bean instanceof Vendas){

            if(empty($this->getById($bean->getId()))){
                return $this->insert($bean);

            } else {
                return $this->update($bean);
            }
        }
        return false;
    }

    private function select($query): array
    {
        $lista = array();
        $result = MySqlDAO::getResult($query);

        while($row = $result->fetch_array()) {
            $lista[] = new Vendas($row['id'], $row['id_pessoa'], $row['data_venda'],
                $row['is_cliente_buscar'], $row['data_cliente_agendou_entrega'],$row['is_cancelada']);
        }

        return $lista;
    }

    private function insert($bean){

        if($bean instanceof Vendas){
            $query = "INSERT INTO vendas (id_pessoa, data_venda, is_cliente_buscar, 
                      data_cliente_agendou_entrega, is_cancelada) values (?,?,?,?,?)";

            $params = array(
                $bean->getIdPessoa(),
                $bean->getDataVenda(),
                $bean->getIsClienteBuscar(),
                $bean->getDataClienteAgendouEntrega(),
                $bean->getIsCancelada()
            );

            $result = MySqlDAO::executeQuery($query,$params);

            if($result != false){
                $bean->setId($result);
                return $bean;
            }
        }
        return false;
    }

    private function update($bean){

        if($bean instanceof Vendas){
            $query = "UPDATE vendas SET id_pessoa=?, data_venda=?, is_cliente_buscar=?, 
                      data_cliente_agendou_entrega=?, is_cancelada=? WHERE id=?";

            $params = array(
                $bean->getIdPessoa(),
                $bean->getDataVenda(),
                $bean->getIsClienteBuscar(),
                $bean->getDataClienteAgendouEntrega(),
                $bean->getIsCancelada(),
                $bean->getId()
            );

            return MySqlDAO::executeQuery($query, $params);
        }
        return false;
    }

}