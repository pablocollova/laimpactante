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
            
            $categorias = $this->categoriaDAO->GetAll();
            require_once(VIEWS_PATH. 'nav-admin.php');
            require_once(VIEWS_PATH. 'agregar-producto.php');
        }

        public function ShowListView(){

            $productos = $this->productoDAO->GetAll();
            require_once(VIEWS_PATH. 'nav-admin.php');
            require_once(VIEWS_PATH. 'listar-productos.php');
        }

        public function ShowEditView($id){

            $producto = $this->productoDAO->getOne($id);
            $categorias = $this->categoriaDAO->GetAll();
            require_once(VIEWS_PATH. 'nav-admin.php');
            require_once(VIEWS_PATH. 'editar-producto.php');
        }

        public function ShowRemoveView($id){

            $producto = $this->productoDAO->getOne($id);
            require_once(VIEWS_PATH. 'nav-admin.php');
            require_once(VIEWS_PATH. 'eliminar-producto.php');
        }

        public function ShowInfo($id){

            $producto = $this->productoDAO->GetOne($id);
            require_once(VIEWS_PATH. 'nav-admin.php');
            require_once(VIEWS_PATH. 'info-producto.php');
        }


        public function Add($codigo, $nombre, $descripcion, $stock, $precioUnitario, $minUnidades, $categoria, $paraVenta){

            if($paraVenta == "true"){
                $paraVenta = true;
            }else{
                $paraVenta = false;
            }

            $producto = new Producto('', $codigo, $nombre, $descripcion, $stock, $precioUnitario, $minUnidades, $categoria, $paraVenta);
            $this->productoDAO->Add($producto);
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
            //if(isset($_SESSION['log'])  if($_SESSION['esAdmin'] == true) 
            if($_SESSION['log'] == false){
                require_once(ROOT . '/Views/header-login.php'); 
                require_once(ROOT . '/Views/nav-principal.php');
            }else{
                require_once(ROOT . '/Views/header.php'); 
                
                if( $_SESSION['esAdmin'] == true){
                    require_once(ROOT . '/Views/nav-admin.php');
                }else{
                    require_once(ROOT . '/Views/nav-user.php');
                }
            }

            $productos = $this->productoDAO->getProductos(); 
           
            require_once(VIEWS_PATH)."catalogo.php";
            require_once(ROOT . '/Views/footer.php');

        }catch(Exception $ex){

            ToolsController::ShowErrorView("Error al obtener los productos del catalogo.", $ex->getMessage(), "/Index");
        }

    }     
}
?>
