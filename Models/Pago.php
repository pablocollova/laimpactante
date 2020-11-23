<?php

    namespace Models;

    class Pago{

        private $id;
        private $fecha;
        private $monto;
        private $medioDePago;
        private $listaVentas;   //Array de Ventas

        public function __construct($id = null, $fecha = null, $monto = null, $medioDePago = null, $listaVentas = null){
            
            $this->id = $id;
            $this->fecha = $fecha;
            $this->monto = $monto;
            $this->medioDePago = $medioDePago;
            $this->listaVentas = $listaVentas;
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

        public function setMedioDePago($medioDePago){
            $this->medioDePago = $medioDePago;
        }

        public function setListaVentas($listaVentas){
            $this->listaVentas = $listaVentas;
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

        public function getMedioDePago(){
            return $this->medioDePago;
        }

        public function getListaVentas(){
            return $this->listaVentas;
        }

    }

?>