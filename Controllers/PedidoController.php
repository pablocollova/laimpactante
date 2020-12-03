<?php

    namespace Controllers;

    use \Exception as Exception;
    use Models\Pedido as Pedido;
    use DAO\PedidoDAO as PedidoDAO;
    use Models\DetallePedido as DetallePedido;
    use DAO\DetallePedidoDAO as DetallePedidoDAO;
    use Models\Producto as Producto;
    use DAO\ProductoDAO as ProductoDAO;

    class PedidoController{

        private $pedidoDAO;
        private $detallePedidoDAO;
        private $productoDAO;
        
        public function __construct(){

            $this->pedidoDAO = new PedidoDAO();
            $this->detallePedidoDAO = new DetallePedidoDAO();
            $this->productoDAO = new ProductoDAO();
        }

        public function AddDetallePedido($idProducto, $cantidad){

            $pedidoEnProceso = $this->pedidoDAO->GetPedidosPorEstado(1);  //Traigo el pedido que está armando el usuario y que todavía no fue enviado al admin
            
            if ($pedidoEnProceso == false){  //Si no hay pedido en proceso entonces se crea uno   
               
                $pedidoEnProceso = new Pedido();
                $pedidoEnProceso->setEstado(1);
                $this->pedidoDAO->Add($pedidoEnProceso, $idUser = null);  //Id Usuario temporaria hasta solucionar la parte usuarios
                $idPedido = $this->pedidoDAO->lastId();
            }else{
                $idPedido = $pedidoEnProceso->getId();
            }
            
            $producto = $this->productoDAO->GetOne($idProducto);
            $detalle = new DetallePedido('', $producto, $cantidad, '', $producto->getPrecioUnitario() * $cantidad);
            $this->detallePedidoDAO->Add($detalle, $idPedido);


        }
    }


?>