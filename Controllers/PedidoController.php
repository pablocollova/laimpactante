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
    use DAO\UsuarioDAO as UsuarioDAO;
    use Models\Venta as Venta;
    use DAO\VentaDAO as VentaDAO;

    class PedidoController{

        private $pedidoDAO;
        private $detallePedidoDAO;
        private $productoDAO;
        private $estadoPedidoDAO;
        private $usuarioDAO;
        private $ventaDAO;
        
        public function __construct(){

            $this->pedidoDAO = new PedidoDAO();
            $this->detallePedidoDAO = new DetallePedidoDAO();
            $this->productoDAO = new ProductoDAO();
            $this->estadoPedidoDAO = new EstadoPedidoDAO();
            $this->usuarioDAO = new UsuarioDAO();
            $this->ventaDAO = new VentaDAO();
        }

        public function AddDetallePedido($idProducto, $cantidad){

            $pedidoEnProceso = $this->pedidoDAO->GetPedidosUsuarioPorEstado($this->estadoPedidoDAO->getIdPorEstado('Actual'), $_SESSION["id"]);  //Traigo el pedido que está armando el usuario y que todavía no fue enviado al admin
            
            if ($pedidoEnProceso == false){  //Si no hay pedido en proceso entonces se crea uno   
               
                $pedidoEnProceso = new Pedido();
                $pedidoEnProceso->setEstado('Actual');
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

            foreach($pedido->getListaDetalles() as $detalle){

                $producto = $detalle->getProducto();
                $nuevoStock = $producto->getStock() - $detalle->getCantidad();
                $this->productoDAO->Edit($producto);
                
                if ($nuevoStock > 0){
                    $producto->setStock($nuevoStock);
                }else{
                    throw new Exception("No hay stock suficiente del producto ". $producto->getNombre());
                }
            }

            $pedido->setEstado("En espera");
            $pedido->setFecha(date("Y-m-d"));
            $pedido->setImporte($this->calcularImporte($pedido->getListaDetalles()));
            $pedido->setDescuento($this->calcularDescuento($pedido->getListaDetalles()));
            $this->pedidoDAO->Edit($pedido);
            $this->ShowListaUsuarioView($_SESSION['id']);
        }


        public function calcularImporte($detalles){

            $importe = 0;
            foreach ($detalles as $detalle){
                $importe += $detalle->getImporte();
            }
            return $importe;    
        }


        public function calcularDescuento($detalles){

            $descuento = 0;
            foreach ($detalles as $detalle){
                $descuento += $detalle->getDescuento();
            }
            return $descuento;
        }


        public function ShowListaUsuarioView($id){

            if ($_SESSION['log'] == false){
                
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }else{

                require_once(VIEWS_PATH. 'header.php');

                $pedidos = $this->pedidoDAO->GetPedidosPorUsuario($id);

                $cliente = $this->usuarioDAO->GetOne($id);

                if($_SESSION['esAdmin'] == true){
                    require_once(VIEWS_PATH. 'nav-admin.php');
                }else{
                    require_once(VIEWS_PATH. 'nav-user.php');
                }
                require_once(VIEWS_PATH. 'listar-pedidos-usuario.php');
            }
            require_once(VIEWS_PATH. 'footer.php');
        }


        public function ShowDetallesUsuarioView($id){

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
                require_once(VIEWS_PATH. 'detalles-pedido-usuario.php');
            }
            require_once(VIEWS_PATH. 'footer.php');
        }


        public function ShowListaAdminView($estado = null){

            if ($_SESSION['esAdmin'] == true){
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');

                $estados = $this->estadoPedidoDAO->GetAll();
                $result = $this->filtrarPedidos($estado);

                if(is_array($result)){

                    $pedidos = $result;
                }else{
                    $pedidos[0] = $result;
                }

                require_once(VIEWS_PATH. 'listar-pedidos-admin.php');

            }else{
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }
            require_once(VIEWS_PATH . 'footer.php');
        }


        public function ShowDetallesAdminView($id){

            if ($_SESSION['esAdmin'] == true){
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');

                $pedido = $this->pedidoDAO->GetOne($id);
                $cliente = $this->usuarioDAO->getUsuarioPorPedido($pedido->getId());
                $detalles = $pedido->getListaDetalles();

                require_once(VIEWS_PATH. 'detalles-pedido-admin.php');

            }else{
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }
            require_once(VIEWS_PATH . 'footer.php');
        }


        public function ShowConfirmarAceptarPedidoView($id){

            if ($_SESSION['esAdmin'] == true){
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');
                require_once(VIEWS_PATH. 'confirmar-aceptar-pedido.php');

            }else{
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }
            require_once(VIEWS_PATH . 'footer.php');
        }


        public function ShowConfirmarRechazarPedidoView($id){

            if ($_SESSION['esAdmin'] == true){
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');
                require_once(VIEWS_PATH. 'confirmar-rechazar-pedido.php');

            }else{
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }
            require_once(VIEWS_PATH . 'footer.php');
        }


        public function aceptarPedido($id, $nroFactura){

            $pedido = $this->pedidoDAO->GetOne($id);
            $pedido->setEstado("Aceptado");
            $this->pedidoDAO->Edit($pedido);
            $venta = new Venta('', $pedido, date("Y-m-d"), $nroFactura);
            $this->ventaDAO->Add($venta);
            $this->ShowDetallesAdminView($id);
        }


        public function rechazarPedido($id){

            $pedido = $this->pedidoDAO->GetOne($id);
            $pedido->setEstado("Rechazado");
            
            foreach($pedido->getListaDetalles() as $detalle){
                $producto = $detalle->getProducto();
                $producto->setStock($producto->getStock() + $detalle->getCantidad());   //Se suman al stock las unidades que formaban parte del pedido
                $this->productoDAO->Edit($producto);
            }   

            $this->pedidoDAO->Edit($pedido);
            $this->ShowDetallesAdminView($id);
        }


        public function agregarNroRemito($id, $nroRemito){

            $pedido = $this->pedidoDAO->getOne($id);
            $pedido->setNroRemito($nroRemito);
            $this->pedidoDAO->Edit($pedido);
            $this->ShowDetallesAdminView($id);
        }


        public function editarNroRemito($id){

            $pedido = $this->pedidoDAO->GetOne($id);
            $pedido->setNroRemito(null);
            $this->pedidoDAO->Edit($pedido);
            $this->ShowDetallesAdminView($id);
        }


        public function filtrarPedidos($estado){

            switch ($estado){

                case "En espera":

                    $pedidos = $this->pedidoDAO->GetPedidosPorEstado($this->estadoPedidoDAO->getIdPorEstado("En espera")); 
                    break;

                case "Aceptado":

                    $pedidos = $this->pedidoDAO->GetPedidosPorEstado($this->estadoPedidoDAO->getIdPorEstado("Aceptado"));
                    break;

                case "Rechazado":

                    $pedidos = $this->pedidoDAO->GetPedidosPorEstado($this->estadoPedidoDAO->getIdPorEstado("Rechazado"));
                    break;

                default:

                    $pedidos = $this->pedidoDAO->GetAll();
                    break;
            }

            return $pedidos;
        }
    }


?>