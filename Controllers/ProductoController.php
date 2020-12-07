<?php

    namespace Controllers;

    use \Exception as Exception;
    use DAO\ProductoDAO as ProductoDAO;
    use DAO\CategoriaDAO as CategoriaDAO;
    use Models\Producto as Producto;

    class ProductoController{

        private $productoDAO;
        private $categoriaDAO;

        public function __construct(){

            $this->productoDAO = new ProductoDAO();
            $this->categoriaDAO = new CategoriaDAO();
        }


        public function ShowAddView(){
            
            if ($_SESSION['esAdmin'] == true){
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');
                $categorias = $this->categoriaDAO->GetAll();
                require_once(VIEWS_PATH. 'agregar-producto.php');
            }else{
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }
            require_once(VIEWS_PATH . 'footer.php');
        }


        public function ShowListView(){
           
            if ($_SESSION['esAdmin'] == true){
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');
                $productos = $this->productoDAO->GetAll();
                require_once(VIEWS_PATH. 'listar-productos.php');
            }else{
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }
            require_once(VIEWS_PATH . 'footer.php');
        }


        public function ShowEditView($id){

            if ($_SESSION['esAdmin'] == true){
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');
                $producto = $this->productoDAO->getOne($id);
                $categorias = $this->categoriaDAO->GetAll();
                require_once(VIEWS_PATH. 'editar-producto.php');
            }else{
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }
            require_once(VIEWS_PATH . 'footer.php');
        }


        public function ShowRemoveView($id){

            if ($_SESSION['esAdmin'] == true){
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');
                $producto = $this->productoDAO->getOne($id);
                require_once(VIEWS_PATH. 'eliminar-producto.php');
            }else{
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }
            require_once(VIEWS_PATH . 'footer.php');
        }


        public function ShowInfo($id){

            if ($_SESSION['log'] == false){
                
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
            }else{
                require_once(VIEWS_PATH. 'header.php');
                
                if($_SESSION['esAdmin'] == true){
                    require_once(VIEWS_PATH. 'nav-admin.php');
                }else{
                    require_once(VIEWS_PATH. 'nav-user.php');
                }
            }
            $producto = $this->productoDAO->GetOne($id);
            require_once(VIEWS_PATH. 'info-producto.php');

            require_once(VIEWS_PATH . 'footer.php');

        }


        public function Add($codigo, $nombre, $descripcion, $stock, $precioUnitario, $minUnidades, $categoria, $paraVenta){

            if($paraVenta == "true"){
                $paraVenta = true;
            }else{
                $paraVenta = false;
            }

            $producto = new Producto('', $codigo, $nombre, $descripcion, $stock, $precioUnitario, $minUnidades, $categoria, $paraVenta);
            $this->productoDAO->Add($producto, $imgContenido);
            $this->ShowListView();
        }


        public function Edit($id, $codigo, $nombre, $descripcion, $stock, $precioUnitario, $minUnidades, $categoria, $paraVenta){

            if($paraVenta == "true"){
                $paraVenta = true;
            }else{
                $paraVenta = false;
            }

            $producto = new Producto($id, $codigo, $nombre, $descripcion, $stock, $precioUnitario, $minUnidades, $categoria, $paraVenta);
            $this->productoDAO->Edit($producto);
            $this->ShowListView();
        }


        public function Remove($id){

            $this->productoDAO->Remove($id);
            $this->ShowListView();
        }
        
   
        public function ShowCatalogo(){

            try{
                if(!isset($_SESSION['log'])){
                    $_SESSION['log'] = false;
                }

                if($_SESSION['log'] == false){
                    require_once(VIEWS_PATH . 'header-login.php'); 
                    require_once(VIEWS_PATH . 'nav-principal.php');

                }else{
                    require_once(VIEWS_PATH . 'header.php'); 

                    if( $_SESSION['esAdmin'] == true){
                        require_once(VIEWS_PATH . 'nav-admin.php');
                    }else{
                        require_once(VIEWS_PATH . 'nav-user.php');
                    }
                }

                $productos = $this->productoDAO->getProductosEnVenta(); 
            
                require_once(VIEWS_PATH . 'catalogo.php');
                require_once(VIEWS_PATH . 'footer.php');

            }catch(Exception $ex){

                ToolsController::ShowErrorView("Error al obtener los productos del catalogo.", $ex->getMessage(), "/Index");
            }

    }     
}
?>
