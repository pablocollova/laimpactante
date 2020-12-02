<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\DetallePedido as DetallePedido;

    class DetallePedidoDAO{

        private $connection;
        private $tableName = "pedidos";

        public function Add(DetallePedido $detallePedido, $idVenta){

            try{
                $query = "INSERT INTO ".$this->tableName." (id_producto, cantidad_producto, descuento_producto, id_venta) VALUES (:idProducto, :cantidad, :descuento, :idVenta); ";
                
                $parameters["idProducto"] = $detalleProducto->getProducto()->getId();
                $parameters["idVenta"] = $idVenta;
                $parameters["cantidad"] = $detalleProducto->getCantidad();
                $parameters["descuento"] = $detalleProducto->getDescuento();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            
            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetDetallesPorPedido($idPedido){
            
            try{
                $detallePedidoList = array();
                $productoDAO = new ProductoDAO();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){    
                    
                    $producto = $productoDAO->GetOne($row["id_producto"]);

                    $detallePedido = new DetallePedido();
                    $detallePedido->setId($row["id_pedido"]);
                    $detallePedido->setProducto($producto);
                    $detallePedido->setCantidad($row["cantidad_producto"]);
                    $detallePedido->setDescuento($row["descuento_producto"]);
                    $detallePedido->setImporte($producto->getPrecioUnitario() * $detallePedido->getCantidad() - $detallePedido->getDescuento());

                    array_push($detallePedidoList, $detallePedido);
                }
                return $detallePedidoList;

            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($id){

            $query = "DELETE FROM " . $this->tableName . " WHERE id_pedido = :id";
            $parameters["id"] = $id;

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        public function Edit(DetallePedido $detallePedido){
            
            $query = "UPDATE " . $this->tableName . " SET id_producto = :idProducto, id_venta = :idVenta, cantidad_producto = :cantidad, descuento_producto = :descuento WHERE id_pedido = :id";
            
            $parameters["idProducto"] = $detalleProducto->getProducto()->getId();
            $parameters["idVenta"] = $idVenta;
            $parameters["cantidad"] = $detalleProducto->getCantidad();
            $parameters["descuento"] = $detalleProducto->getDescuento();
            $parameters["id"] = $detalleProducto->getId();

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }
    
        protected function mapear($value){
            
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                $producto = $productoDAO->GetOne($p["id_producto"]);
                return new DetallePedido($p["id_producto"], $p["cantidad_producto"], $p["descuento_producto"], '');
            }, $value);
            
            $productoDAO = new ProductoDAO();
            foreach($resp as $detalle){
                $detalle->setProducto($productoDAO->GetOne($detalle->getProducto()));
                $detalle->setImporte($detalle->getProducto()->getPrecioUnitario() * $detalle->getCantidad() - $detalle->getDescuento());
            }
            return count($resp) > 1 ? $resp : $resp["0"];
        }
        
        
    }

?>