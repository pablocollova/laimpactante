<?php

    namespace DAO;

    use \Exception as Exception;
    
    class EstadoPedidoDAO{

        private $connection;
        private $tableName = "estados_pedido";

        public function getEstadoPorId($id){

            $query = "SELECT descripcion FROM ". $this->tableName . " WHERE id_estadopedido = " . $id;
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

            }catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                return $resultSet[0]['descripcion'];
            }else{
                return false;
            }
        }

        public function getIdPorEstado($estado){

            $query = "SELECT id_estadopedido FROM ". $this->tableName . " WHERE descripcion = '" . $estado . "'";
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

            }catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                return $resultSet[0]['id_estadopedido'];
            }else{
                return false;
            }
        }
    }
?>