<?php

    namespace Models;

    class Categoria{

        private $id;
        private $nombre;
        private $descuento;

        public function __construct($id = null, $nombre = null, $descuento = null){

            $this->id = $id;
            $this->nombre = $nombre;
            $this->descuento = $descuento;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setDescuento($descuento){
            $this->descuento = $descuento;
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getDescuento(){
            return $this->descuento;
        }
    }
?>