<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Venta as Venta;

    class VentaDAO{

        private $connection;
        private $tableName = "ventas";

        public function Add(Venta $venta){

            try{
                $query = "UPDATE " .$this->tableName." SET fecha = :fecha, nro_factura_venta = :nroFactura WHERE id_venta = :idVenta";
                
                $parameters["fecha"] = $venta->getFecha();
                $parameters["nroFactura"] = $venta->getNroFactura();
                $parameters["idVenta"] = $venta->getPedido()->getId();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            
            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetAll(){
            
            try{
                $ventaList = array();
                $pedidoDAO = new PedidoDAO();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){        

                    $venta = new Venta();
                    $venta->setId($row["id_venta"]);
                    $venta->setFecha($row["fecha"]);
                    $venta->setNroFactura($row["nro_factura_venta"]);
                    $venta->setPedido($pedidoDAO->GetOne($row["id_venta"]));

                    array_push($productoList, $venta);
                }
                return $productoList;

            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetOne($id){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_venta = :id";
            $parameters["id"] = $id;

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

            }catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                return $this->mapear($resultSet);
            }else{
                return false;
            }
        }


        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Venta($p["id_venta"], '', $p["fecha"], $p["nro_factura_venta"]);
            }, $value);
            
            $pedidoDAO = new PedidoDAO();
            foreach($resp as $venta){
                $venta->setPedido($pedidoDAO->getOne($venta->getId()));
            }
            return count($resp) > 1 ? $resp : $resp["0"];
        }
        
        
    }

?>