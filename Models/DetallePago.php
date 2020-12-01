<?php

    namespace Models;

    class DetallePago{

        private $nroFactura;
        private $monto;

        public function __construct($nroFactura = null, $monto = null){

            $this->nroFactura = $nroFactura;
            $this->monto = $monto;
        }

        public function setNroFactura($nroFactura){
            $this->nroFactura = $nroFactura;
        }

        public function setMonto($monto){
            $this->monto = $monto;
        }

        public function getNroFactura($nroFactura){
            return $this->nroFactura;
        }

        public function getMonto($monto){
            return $this->monto;
        }
    }
?>