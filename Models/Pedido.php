<?php

    namespace Models;

    class Pedido{

        private $id;
        private $fecha;
        private $listaDetalles;     //Array de DetallePedido 
        private $estado;            //1.Actual (Pedido que el cliente no envío todavía), 2.En espera, 3.Aceptado, 4.Rechazado
        private $importe;
        private $descuento;
        private $nroRemito;

        public function __construct($id = null, $fecha = null, $listaDetalles = null, $estado = null, $importe = null, $descuento = null, $nroRemito = null){

            $this->id = $id;
            $this->fecha = $fecha;
            $this->listaDetalles = $listaDetalles;
            $this->estado =$estado;
            $this->importe = $importe;
            $this->descuento = $descuento;
            $this->nroRemito = $nroRemito;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function setListaDetalles($listaDetalles){
            $this->listaDetalles = $listaDetalles;
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

        public function setNroRemito($nroRemito){
            $this->nroRemito = $nroRemito;
        }

        public function getId(){
            return $this->id;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function getListaDetalles(){
            return $this->listaDetalles;
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

        public function getNroRemito(){
            return $this->nroRemito;
        }
    }

?>