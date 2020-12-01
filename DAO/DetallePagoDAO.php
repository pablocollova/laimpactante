<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\DetallePago as DetallePago;

    class ProductoDAO{

        private $connection;
        private $tableName = "detalle_pagos";

        public function Add(DetallePago $detalle, $idPago){

            try{
                $query = "INSERT INTO ".$this->tableName." (id_pago, monto, nro_factura) VALUES (idPago, monto, nroFactura);";
                
                $parameters["idPago"] = $idPago;
                $parameters["monto"] = $detalle->getMonto();
                $parameters["nroFactura"] = $detalle->getNroFactura();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            
            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetDetallesDePago($idPago){
            
            try{
                $productoList = array();

                $query = "SELECT * FROM ".$this->tableName. "WHERE id_pago = " . $idPago;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){        

                    $detalle = new DetallePago();
                    $detalle->setNroFactura($row["nro_factura"]);
                    $detalle->setMonto($row["monto"]);

                    array_push($productoList, $detalle);
                }
                return $productoList;

            }catch(Exception $ex){
                throw $ex;
            }
        }
    

        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new DetallePago($p["nro_factura"], $p["monto"]);
            }, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }
        
    }

?>