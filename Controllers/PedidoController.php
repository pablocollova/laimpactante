<?php

    namespace Controllers;

    use \Exception as Exception;
    use Models\Pedido as Pedido;
    use DAO\PedidoDAO as PedidoDAO;
    use Models\DetallePedido as DetallePedido;
    use DAO\DetallePedidoDAO as DetallePedidoDAO;
    use Models\Producto as Producto;
    use DAO\ProductoDAO as ProductoDAO;
    use DAO\EstadoPedidoDAO as EstadoPedidoDAO;

    class PedidoController{

        private $pedidoDAO;
        private $detallePedidoDAO;
        private $productoDAO;
        private $estadoPedidoDAO;
        
        public function __construct(){

            $this->pedidoDAO = new PedidoDAO();
            $this->detallePedidoDAO = new DetallePedidoDAO();
            $this->productoDAO = new ProductoDAO();
            $this->estadoPedidoDAO = new EstadoPedidoDAO();
        }

        public function AddDetallePedido($idProducto, $cantidad){

            $pedidoEnProceso = $this->pedidoDAO->GetPedidosUsuarioPorEstado($this->estadoPedidoDAO->getIdPorEstado('Actual'), $_SESSION["id"]);  //Traigo el pedido que está armando el usuario y que todavía no fue enviado al admin
            
            if ($pedidoEnProceso == false){  //Si no hay pedido en proceso entonces se crea uno   
               
                $pedidoEnProceso = new Pedido();
                $pedidoEnProceso->setEstado($this->estadoPedidoDAO->getIdPorEstado('Actual'));
                $this->pedidoDAO->Add($pedidoEnProceso, $_SESSION['id']);
                $idPedido = $this->pedidoDAO->lastId();
            }else{
                $idPedido = $pedidoEnProceso->getId();
            }
            
            $producto = $this->productoDAO->GetOne($idProducto);
            $detalle = new DetallePedido('', $producto, $cantidad, '', $producto->getPrecioUnitario() * $cantidad);
            $this->detallePedidoDAO->Add($detalle, $idPedido);
            $this->ShowPedidoEnProcesoView();
        }


        public function RemoveDetallePedido($id){       //Borrar un detalle de un pedido que no fue enviado al admin

            $this->detallePedidoDAO->Remove($id);
            $this->ShowPedidoEnProcesoView();
        }


        public function ShowPedidoEnProcesoView(){

            if ($_SESSION['log'] == false){
                
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }else{

                require_once(VIEWS_PATH. 'header.php');

                $pedidoEnProceso = $this->pedidoDAO->GetPedidosUsuarioPorEstado($this->estadoPedidoDAO->getIdPorEstado('Actual'), $_SESSION["id"]);
                $detallesLista = array();
                if ($pedidoEnProceso != false){
                    $detallesLista = $pedidoEnProceso->getListaDetalles();
                }
                
                if($_SESSION['esAdmin'] == true){
                    require_once(VIEWS_PATH. 'nav-admin.php');
                }else{
                    require_once(VIEWS_PATH. 'nav-user.php');
                }
                require_once(VIEWS_PATH. 'pedido-en-proceso.php');
            }
            require_once(VIEWS_PATH. 'footer.php');
        }


        public function ShowConfirmarEnvioPedidoView($id){

            if ($_SESSION['log'] == false){
                
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }else{

                require_once(VIEWS_PATH. 'header.php');
                
                if($_SESSION['esAdmin'] == true){
                    require_once(VIEWS_PATH. 'nav-admin.php');
                }else{
                    require_once(VIEWS_PATH. 'nav-user.php');
                }
                require_once(VIEWS_PATH. 'confirmar-envio-pedido.php');
            }
            require_once(VIEWS_PATH. 'footer.php');
        }


        public function enviarPedido($id){

            $pedido = $this->pedidoDAO->GetOne($id);
            $pedido->setEstado($this->estadoPedidoDAO->getIdPorEstado("En espera"));
            $pedido->setFecha(date("Y-m-d H:i:s"));
            //falta setearle a pedido el importe y los descuentos
            $this->pedidoDAO->Edit($pedido);
            $this->ShowListView();

        }


        public function ShowListView(){

            if ($_SESSION['log'] == false){
                
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }else{

                require_once(VIEWS_PATH. 'header.php');

                $pedidos = $this->pedidoDAO->GetPedidosPorUsuario($_SESSION["id"]);
                
                if($_SESSION['esAdmin'] == true){
                    require_once(VIEWS_PATH. 'nav-admin.php');
                }else{
                    require_once(VIEWS_PATH. 'nav-user.php');
                }
                require_once(VIEWS_PATH. 'listar-pedidos-usuario.php');
            }
            require_once(VIEWS_PATH. 'footer.php');
        }


        public function ShowDetallesView($id){

            if ($_SESSION['log'] == false){
                
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }else{

                require_once(VIEWS_PATH. 'header.php');

                $detalles = $this->detallePedidoDAO->GetDetallesPorPedido($id);
                
                if($_SESSION['esAdmin'] == true){
                    require_once(VIEWS_PATH. 'nav-admin.php');
                }else{
                    require_once(VIEWS_PATH. 'nav-user.php');
                }
                require_once(VIEWS_PATH. 'listar-detalles-pedido.php');
            }
            require_once(VIEWS_PATH. 'footer.php');
        }
    }


?>