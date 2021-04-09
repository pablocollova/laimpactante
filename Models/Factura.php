<?php

    namespace Models;

    class Factura{

        private $id;
        private $fecha;
        private $monto;
        private $letra;
        private $listaPagos;   //Array de Pagos
        private $idCliente;
        private $nroFactura;
        
        public function __construct($id = null, $fecha = null, $monto = null, $medioDePago = null, $listaDetalles = null, $nroRecibo = null, $idCliente=null){
            
            $this->id = $id;
            $this->fecha = $fecha;
            $this->monto = $monto;
            $this->listaPagos;
            $this->idCliente=$idCliente;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function setMonto($monto){
            $this->monto = $monto;
        }

        public function setListaPagos($listaPagos){
            $this->listaPagos = $listaPagos;
        }

        public function setNroFactura($nroFactura){
            $this->nroFactura = $nroFactura;
        }

        public function getId(){
            return $this->id;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function getMonto(){
            return $this->monto;
        }


        public function getListaPagos(){
            return $this->listaPagos;
        }

        public function getNroFactura(){
            return $this->nroFactura;
        }

    }

?>