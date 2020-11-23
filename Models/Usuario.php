<?php

    namespace Models;

    class Usuario{

        private $id;
        private $nombre;
        private $apellido;
        private $email;
        private $password;
        private $dni;
        private $telefono;
        private $calle;
        private $altura;
        private $razonSocial;
        private $esAdmin;
        private $ctaCorriente;
        private $listaPedidos;      //Array de pedidos

        public function __construct($id = null, $nombre = null, $apellido = null, $email = null, $password = null,
        $dni = null, $telefono = null, $calle = null, $altura = null, $razonSocial = null, $esAdmin = null,
        CuentaCorriente $ctaCorriente = null, $listaPedidos = null){

            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->email = $email;
            $this->password = $password;
            $this->dni = $dni;
            $this->telefono = $telefono;
            $this->calle = $calle;
            $this->altura = $altura;
            $this->razonSocial = $razonSocial;
            $this->esAdmin = $esAdmin;
            $this->ctaCorriente = $ctaCorriente;
            $this->listaPedidos = $listaPedidos;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setApellido($apellido){
            $this->apellido = $apellido;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function setDni($dni){
            $this->dni = $dni;
        }

        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }

        public function setCalle($calle){
            $this->calle = $calle;
        }

        public function setAltura($altura){
            $this->altura = $altura;
        }

        public function setRazonSocial($razonSocial){
            $this->razonSocial = $razonSocial;
        }

        public function setEsAdmin($esAdmin){
            $this->esAdmin = $esAdmin;
        }

        public function setCtaCorriente(CuentaCorriente $ctaCorriente){
            $this->ctaCorriente = $ctaCorriente;
        }

        public function setListaPedidos($listaPedidos){
            $this->listaPedidos = $listaPedidos;
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getApellido(){
            return $this->apellido;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getDni(){
            return $this->dni;
        }

        public function getTelefono(){
            return $this->telefono;
        }

        public function getCalle(){
            return $this->calle;
        }

        public function getAltura(){
            return $this->altura;
        }

        public function getRazonSocial(){
            return $this->razonSocial;
        }

        public function getEsAdmin(){
            return $this->esAdmin;
        }

        public function getCtaCorriente(){
            return $this->ctaCorriente;
        }

        public function getListaPedidos(){
            return $this->listaPedidos;
        }
    }

?>