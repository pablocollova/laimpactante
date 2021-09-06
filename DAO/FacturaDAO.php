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
                
               
                $parameters["idPedido"] = $factura->getIdPedido();
                $parameters["letra"] = $factura->getLetra();
                $parameters["nroFactura"]=$factua->getNroFactura();
                $parameters["fecha"] = $pago->getFecha();
                $parameters["total"] = $pago->getMonto();
                $parameters["tipo"]=$pago->getTipo();
                $parameters["pagado"]=$pago->getPagado();
                $parameters["cancelado"] = $pago->getNroRecibo();

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
                $facturasList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){        

                    $factura = new Factura();
                    $factura->setId($row["id_factura"]);
                    $factura->setIdPedido($row["id_pedido"]);
                    $factura->setFecha($row["fecha_factura"]);
                    $factura->setLetra($row["letra_factura"]);
                    $factura->setNroFactura($row["nro_factura"]);
                    $factura->setMonto($row["total_factura"]);
                    $factura->setTipo($row["tipo_factura"]);
                    $factura->setPagado($row["pagado"]);
                    $factura->setCancelado($row["cancelado"]);
                    
                    $factura->setListaDetalles($detallePagoDAO->GetDetallesDePago($row["id_pago"]));

                    array_push($facturasList, $factura);
                }
                return $facturasList;

            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetOne($id){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_factura = :id";
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
                return new factura($p["id_factura"], $p["id_pedido"], $p["fecha_factura"], $p["letra_factura"], '', $p["nro_factura"], $p["total_factura"], $p["tipo_factura"], $p["pagado"], $p["cancelado"]);
            }, $value);
            
            $detallePagoDAO = new DetallePagoDAO();
            foreach($resp as $pago){
                $pago->setListaDetalles($detallePagoDAO->GetDetallesDePago($pago->getId()));
            }

            return count($resp) > 1 ? $resp : $resp["0"];
        }
        
        
    }

?>