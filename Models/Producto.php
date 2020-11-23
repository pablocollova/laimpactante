<?php

    namespace Models;

    class Producto{
        
        private $id;
        private $codigo;
        private $nombre;
        private $descripcion;
        private $stock;
        private $precioUnitario;
        private $minUnidades;
        private $categoria;

        public function __construct($id = null, $codigo = null, $nombre = null, $descripcion = null, $stock = null, $precioUnitario = null, $minUnidades = null, $categoria = null){
            
            $this->id = $id;
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->stock = $stock;
            $this->precioUnitario = $precioUnitario;
            $this->minUnidades = $minUnidades;
            $this->categoria = $categoria;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        public function setStock($stock){
            $this->stock = $stock;
        }

        public function setPrecioUnitario($precioUnitario){
            $this->precioUnitario = $precioUnitario;
        }

        public function setMinUnidades($minUnidades){
            $this->minUnidades = $minUnidades;
        }

        public function setCategoria($categoria){
            $this->categoria = $categoria;
        }

        public function getId(){
            return $this->id;
        }

        public function getCodigo(){
            return $this->codigo;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }

        public function getStock(){
            return $this->stock;
        }

        public function getPrecioUnitario(){
            return $this->precioUnitario;
        }

        public function getMinUnidades(){
            return $this->minUnidades;
        }

        public function getCategoria(){
            return $this->categoria;
        }

    }

?>