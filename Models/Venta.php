<?php

    namespace Models;

    class Venta{

        private $id;
        private $pedido;
        private $fecha;
        private $nroFactura;

        public function __construct($id = null, $pedido = null, $fecha = null, $nroFactura = null){

            $this->id = $id;
            $this->pedido = $pedido;
            $this->fecha = $fecha;
            $this->nroFactura = $nroFactura;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setPedido($pedido){
            $this->pedido = $pedido;
        }
        
        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function setNroFactura($nroFactura){
            $this->nroFactura = $nroFactura;
        }

        public function getId(){
            return $this->id;
        }

        public function getPedido(){
            return $this->pedido;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function getNroFactura(){
            return $this->nroFactura;
        }
    }
?>