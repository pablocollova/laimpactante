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

            try{
                $pedidoEnProceso = $this->pedidoDAO->GetPedidosUsuarioPorEstado($this->estadoPedidoDAO->getIdPorEstado('Actual'), $_SESSION["id"]);  //Traigo el pedido que está armando el usuario y que todavía no fue enviado al admin
                $agregado = false;      //Controla si se agrega
    
                if ($pedidoEnProceso == false){  //Si no hay pedido en proceso entonces se crea uno   
                   
                    $pedidoEnProceso = new Pedido();
                    $pedidoEnProceso->setEstado('Actual');
                    $this->pedidoDAO->Add($pedidoEnProceso, $_SESSION['id']);
                    $idPedido = $this->pedidoDAO->lastId();
    
                }else{                          //Si ya hay pedido en proceso entonces se busca si existe un detalle que corresponde al producto a agregar
                    $idPedido = $pedidoEnProceso->getId();
    
                    foreach($pedidoEnProceso->getListaDetalles() as $detalle){
    
                        if($detalle->getProducto()->getId() == $idProducto){        //Si lo hay, se suman las cantidades y agregado es true
                            $this->detallePedidoDAO->Edit($detalle->getId(), $cantidad);
                            $agregado = true;
                        }
                    }
                }
                
                if (!$agregado){       //Si no está agregado significa que no hay un detalle de ese producto, por lo que se agrega
                    $producto = $this->productoDAO->GetOne($idProducto);
                    $detalle = new DetallePedido('', $producto, $cantidad, '', $producto->getPrecioUnitario() * $cantidad);
                    $this->detallePedidoDAO->Add($detalle, $idPedido);
                }
                $this->ShowPedidoEnProcesoView();

            }catch (Exception $e){

                ToolsController::ShowErrorView("No se pudo agregar el producto al pedido.", "Producto/ShowCatalogo/");
            }
        }


        public function RemoveDetallePedido($id){       //Borrar un detalle de un pedido que no fue enviado al admin

            try{
                $this->detallePedidoDAO->Remove($id);
            }catch (Exception $e){
                ToolsController::ShowErrorView("No se pudo eliminar el detalle del producto.", "Producto/ShowCatalogo/");
            }
            $this->ShowPedidoEnProcesoView();
        }


        public function ShowPedidoEnProcesoView(){

            try{
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

            }catch (Exception $e){
                ToolsController::ShowErrorView("No se pudo cargar el pedido en proceso.", "Producto/ShowCatalogo/");
            }
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

            try{
                $pedido = $this->pedidoDAO->GetOne($id);
    
                foreach($pedido->getListaDetalles() as $detalle){
    
                    $producto = $detalle->getProducto();
                    $nuevoStock = $producto->getStock() - $detalle->getCantidad();
                    if ($nuevoStock >= 0){
                        $producto->setStock($nuevoStock);
                        $this->productoDAO->Edit($producto);
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

            }catch (Exception $e){
                ToolsController::ShowErrorView("No pudo enviarse el pedido.", "Producto/ShowCatalogo/");
            }
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
                $pedidos = array();

                if(is_array($result)){

                    $pedidos = $result;
                }elseif($result != false){
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

            try{
                $pedido = $this->pedidoDAO->GetOne($id);
                $pedido->setEstado("Aceptado");
                $this->pedidoDAO->Edit($pedido);
                $venta = new Venta('', $pedido, date("Y-m-d"), $nroFactura);
                $this->ventaDAO->Add($venta);
                $this->ShowDetallesAdminView($id);

            }catch (Exception $e){
                ToolsController::ShowErrorView("No se pudo aceptar el pedido correctamente.", "Pedido/ShowListaAdminView/");
            }
        }


        public function rechazarPedido($id){

            try{
                
                $pedido = $this->pedidoDAO->GetOne($id);
                $pedido->setEstado("Rechazado");
                
                foreach($pedido->getListaDetalles() as $detalle){
                    $producto = $detalle->getProducto();
                    $producto->setStock($producto->getStock() + $detalle->getCantidad());   //Se suman al stock las unidades que formaban parte del pedido
                    $this->productoDAO->Edit($producto);
                }   
    
                $this->pedidoDAO->Edit($pedido);
                $this->ShowDetallesAdminView($id);

            }catch (Exception $e){
                ToolsController::ShowErrorView("No se pudo rechazar el pedido correctamente.", "Pedido/ShowListaAdminView/");
            }
        }


        public function agregarNroRemito($id){

            try{
                
                $pedido = $this->pedidoDAO->getOne($id);
                $pedido->setNroRemito($id);
                $this->pedidoDAO->Edit($pedido);
                $this->ShowDetallesAdminView($id);

            }catch (Exception $e){
                ToolsController::ShowErrorView("No se pudo agregar el número de remito.", "Pedido/ShowListaAdminView/");
            }
        }


        public function editarNroRemito($id){

            try{
                
                $pedido = $this->pedidoDAO->GetOne($id);
                $pedido->setNroRemito(null);
                $this->pedidoDAO->Edit($pedido);
                $this->ShowDetallesAdminView($id);

            }catch (Exception $e){
                ToolsController::ShowErrorView("No se pudo editar el pedido.", "Pedido/ShowListaAdminView/");
            }
        }


        public function filtrarPedidos($estado){

            try{
                
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

            }catch (Exception $e){
                ToolsController::ShowErrorView("No se pudieron filtrar los pedidos.", "Producto/ShowCatalogo/");
            }
        }
    }


?>