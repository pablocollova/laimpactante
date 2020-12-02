<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Pedido as Pedido;

    class PedidoDAO{

        private $connection;
        private $tableName = "ventas";

        public function Add(Pedido $pedido, $idUser){

            $detallePedidoDAO = new DetallePedidoDAO();
            try{
                $query = "INSERT INTO ".$this->tableName." (fecha_pedido, estado_pedido, total, descuento_venta, id_cliente) VALUES (:fecha, :estado, :importe, :descuento, :idCliente);";
                
                $parameters["fecha"] = $pedido->getFecha();
                $parameters["estado"] = $pedido->getEstado();
                $parameters["importe"] = $pedido->getImporte();
                $parameters["descuento"] = $pedido->getDescuento();
                $parameters["idCliente"] = $idUser;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
                $id = $this->lastId();
                foreach($pedido->getListaDetalles() as $detalle){
                    $detallePedidoDAO->Add($detalle, $id);
                }

            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetAll(){
            
            try{
                $productoList = array();
                $detallePedidoDAO = new DetallePedidoDAO();
                
                $query = "SELECT * FROM ".$this->tableName;
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){        
                    
                    $listaDetalle = $detallePedidoDAO->GetDetallesPorPedido($row["id_venta"]);
                    $pedido = new Pedido();
                    $pedido->setId($row["id_venta"]);
                    $pedido->setFecha($row["fecha_pedido"]);
                    $pedido->setListaDetalles($listaDetalle);
                    $pedido->setEstado($row["estado_pedido"]);
                    $pedido->setImporte($row["total"]);
                    $pedido->setDescuento($row["descuento_venta"]);
                    $pedido->setNroRemito($row["nro_remito"]);


                    array_push($productoList, $pedido);
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


        public function Remove($id){

            $query = "DELETE FROM " . $this->tableName . " WHERE id_venta = :id";
            $parameters["id"] = $id;

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        public function Edit(Producto $productoActualizado){
            
            $query = "UPDATE " . $this->tableName . " SET fecha_pedido = :fecha, estado_pedido = :fecha, total = :total, descuento_venta = :descuento, nro_remito = :nroRemito WHERE id_venta = :id";
            
            $parameters["fecha"] = $pedido->getFecha();
            $parameters["estado"] = $pedido->getEstado();
            $parameters["importe"] = $pedido->getImporte();
            $parameters["descuento"] = $pedido->getDescuento();
            $parameters["nroRemito"] = $pedido->getNroRemito();
            $parameters["id"] = $pedido->getId();

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        public function lastId(){

            try{
                $query = "SELECT MAX(id) AS id FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            
            }catch(Exception $ex){
                throw $ex;
            }

           return $resultSet[0]['id'];
        }
    
        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Pedido($p["id_venta"], $p["fecha"], '', $p["estado_pedido"], $p["total"], $p["descuento_venta"], $p["nro_remito"]);
            }, $value);
            
            $detallePedidoDAO = new DetallePedido();
            foreach($resp as $pedido){
                $pedido->setListaDetalles($detallePedidoDAO->GetDetallesPorPedido($pedido->getId()));
            }

            return count($resp) > 1 ? $resp : $resp["0"];
        }
        
        
    }

?>