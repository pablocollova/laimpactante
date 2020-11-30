<?php

    namespace Models;

    class DetallePedido{

        private $id;
        private $producto;
        private $cantidad;
        private $descuento;
        private $importe;
        
        public function __construct(Producto $producto = null, $cantidad = null, $descuento = null, $importe = null){

            $this->producto = $producto;
            $this->cantidad = $cantidad;
            $this->descuento = $descuento;
            $this->importe = $importe;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setProducto(Producto $producto){
            $this->producto = $producto;
        }

        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }

        public function setDescuento($descuento){
            $this->descuento = $descuento;
        }

        public function setImporte($importe){
            $this->importe = $importe;
        }

        public function getId(){
            return $this->id;
        }

        public function getProducto(){
            return $this->producto;
        }

        public function getCantidad(){
            return $this->cantidad;
        }

        public function getDescuento(){
            return $this->descuento;
        }

        public function getImporte(){
            return $this->importe;
        }
    }
?>