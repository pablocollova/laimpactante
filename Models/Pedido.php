<?php

    namespace Models;

    class Pedido{

        private $id;
        private $fecha;
        private $listaDetalles;     //Array de DetallePedido 
        private $estado;            //Aceptado, En espera, Rechazado
        private $importe;
        private $descuento;

        public function __construct($id = null, $fecha = null, $listaProductos = null, $estado = null, $importe = null, $descuento = null){

            $this->id = $id;
            $this->fecha = $fecha;
            $this->listaPoductos = $listaPoductos;
            $this->estado =$estado;
            $this->importe = $importe;
            $this->descuento = $descuento;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function setListaProductos($listaPoductos){
            $this->listaProductos = $listaPoductos;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }

        public function setImporte($importe){
            $this->importe = $importe;
        }

        public function setDescuento($descuento){
            $this->descuento = $descuento;
        }

        public function getId(){
            return $this->id;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function getListaProductos(){
            return $this->listaProductos;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function getImporte(){
            return $this->importe;
        }

        public function getDescuento(){
            return $this->descuento;
        }
    }

?>