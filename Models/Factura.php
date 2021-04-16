


<?php

/*CREATE TABLE facturas
 (
	id_factura int unsigned auto_increment,
	id_pedido int unsigned,
    fecha_factura date,
	letra_factura char,
	nro_factura int unsigned,
	total_factura float,
	tipo_factura char,
	pagado float,
	cancelado int,
	constraint pk_factura primary key(id_factura),
	constraint fk_pedido foreign key (id_pedido) references pedidos (id_pedido)
 );*/

    namespace Models;

    class Factura{

        private $id;
        private idPedido;
        private $fecha;
        private $monto;
        private $letra;
        private $nroFactura;
        private $listaPagos;   //Array de Pagos
        private $idCliente;
        private $nroFactura;
        
        public function __construct( $id=
        null, $idPedido=null, $letra=null, $nroFactura=null, $total=null, $tipo=null, $pagado=null, $cancelado=null,$fecha = null, $monto = null, $medioDePago = null ){
            
            $this->id = $id;
            $this->fecha = $fecha;
            $this->monto = $monto;
            $this->listaPagos;
            $this->idCliente=$idCliente;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function setLetra($letra){
            $this->letra = $letra;
        }

        public function setMonto($monto){
            $this->monto = $monto;
        }

        public function setListaPagos($listaPagos){
            $this->listaPagos = $listaPagos;
        }

        public function setNroFactura($nroFactura){
            $this->nroFactura = $nroFactura;
        }

        public function setIdPedido($idPedido){
            $this->idPedido=$idPedido;
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


        public function getListaPagos(){
            return $this->listaPagos;
        }

        public function getNroFactura(){
            return $this->nroFactura;
        }

        public function getIdPedido(){
            return $this->idPedido;
        }

        public function getLetra(){
            return $this->letra;
        }

    }

?>