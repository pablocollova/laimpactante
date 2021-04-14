<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Factura as Factura;
    
    class FacturaDAO{

        private $connection;
        private $tableName = "facturas";

        public function Add(Factura $factura){

            try{
                $query = "INSERT INTO ".$this->tableName." (id_pedido, letra_factura, nro_factura, total_factura, tipo_factura, pagado, cancelado, fecha ) VALUES (:idPedido, :letra, :nroFactura, :total, :tipo, :pagado, :cancelado, :fecha);";
                
                idPedido, :letra, :nroFactura, :total, :tipo, :pagado, :cancelado, :fecha
                $parameters["idPedido"] = $idPedido;
                $parameters["letra"] = $pago->getMonto();
                $parameters["fecha"] = $pago->getFecha();
                $parameters["mediodepago"] = $pago->getMedioDePago();
                $parameters["nroRecibo"] = $pago->getNroRecibo();

                $id = $this->lastId();
                $detallePagoDAO = new DetallePagoDAO();

             //   foreach($pago->getListaDetalles() as $detalle){
             //       $detallePagoDAO->Add($detalle);
             //   }

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            
            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetAll(){
            
            try{
                $productoList = array();
                $detallePagoDAO = new DetallePagoDAO();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){        

                    $pago = new Pago();
                    $pago->setId($row["id_pago"]);
                    $pago->setFecha($row["fecha"]);
                    $pago->setMonto($row["monto"]);
                    $pago->setMedioDePago($row["mediodepago"]);
                    $pago->setNroRecibo($row["nro_recibo"]);
                    $pago->setListaDetalles($detallePagoDAO->GetDetallesDePago($row["id_pago"]));

                    array_push($productoList, $pago);
                }
                return $productoList;

            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetOne($id){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_pago = :id";
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


        public function lastId(){

            try{
                $query = "SELECT MAX(id_pago) AS id FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

            } catch(Exception $ex){
                throw $ex;
            }

           return $resultSet[0]['id'];
        }

    
        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Pago($p["id_pago"], $p["fecha"], $p["monto"], $p["mediodepago"], '', $p["nro_recibo"], $p["idCliente"]);
            }, $value);
            
            $detallePagoDAO = new DetallePagoDAO();
            foreach($resp as $pago){
                $pago->setListaDetalles($detallePagoDAO->GetDetallesDePago($pago->getId()));
            }

            return count($resp) > 1 ? $resp : $resp["0"];
        }
        
        
    }

?>