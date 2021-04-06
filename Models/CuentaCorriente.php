<?php
    
    namespace Models;

    class CuentaCorriente{

        private $id;
        private $listaFacturas;   //Array de Ventas
        private $listaPagos;    //Array de Pagos

        public function __construct($id = null, $listaVentas = null, $listaPagos = null){

            $this->id = $id;
            $this->listaFacturas = $listaFacturas;
            $this->listaPagos = $listaPagos;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setListaFacturas($listaFacturas){
            $this->listaVentas = $listaVentas;
        }

        public function setListaPagos($listaPagos){
            $this->listaPagos = $listaPagos;
        }

        public function getId(){
            return $this->id;
        }

        public function getListaVentas(){
            return $this->listaVentas;
        }

        public function getListaPagos(){
            return $this->listaPagos;
        }
    }
?>