<?php

    namespace Controllers;

    use \Exception as Exception;
    use DAO\ProductoDAO as ProductoDAO;
    use DAO\CategoriaDAO as CategoriaDAO;
    use Models\Producto as Producto;
    use \Images as imageFolder;

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


        public function ShowListView($categoria = null){
           
            if ($_SESSION['esAdmin'] == true){
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');
                $categorias = $this->categoriaDAO->GetAll();

                if ($categoria == null){    
                    $productos = $this->productoDAO->GetAll();
                }else{
                    $productos = $this->productoDAO->getProductosPorCategoria($categoria);
                }
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

                $arrayCategorias = $producto->getCategorias();
                $categoriasJSON = '[';

                foreach($arrayCategorias as $nombreCategoria){
                    $categoriasJSON = $categoriasJSON . '{"categoria":"' .$nombreCategoria. '"},';
                }

                $categoriasJSON = substr($categoriasJSON, 0, -1);
                $categoriasJSON = $categoriasJSON . ']';

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

        private function agregarImagenes($nombreProducto){

            if(isset($_FILES["imagenes"]) && $_FILES["imagenes"]["name"][0])
            {
         
                # recorremos todos los arhivos que se han subido
                for($i=0;$i<count($_FILES["imagenes"]["name"]);$i++)
                {
         
                    # si es un formato de imagen
                    if($_FILES["imagenes"]["type"][$i]=="image/jpeg" || $_FILES["imagenes"]["type"][$i]=="image/pjpeg" || $_FILES["imagenes"]["type"][$i]=="image/gif" || $_FILES["imagenes"]["type"][$i]=="image/png")
                    {
        
                        # si exsite la carpeta o se ha creado
                        if(file_exists(IMAGES_PATH) || @mkdir(IMAGES_PATH))
                        {
                            $origen=$_FILES["imagenes"]["tmp_name"][$i];
                            $file_explode=explode(".",$_FILES["imagenes"]["name"][$i]);
                            $destino=IMAGES_PATH.$nombreProducto ."-image-".$i.".".$file_explode[1];

                            # movemos el archivo
                            if(@move_uploaded_file($origen, $destino))
                            {
                                echo "<br>".$_FILES["imagenes"]["name"][$i]." movido correctamente";
                            }else{
                                echo "<br>No se ha podido mover el archivo: ".$_FILES["imagenes"]["name"][$i];
                            }
                        }else{
                            echo "<br>No se ha podido crear la carpeta: ".$carpetaDestino;
                        }
                    }else{
                        echo "<br>".$_FILES["imagenes"]["name"][$i]." - NO es imagen jpg, png o gif";
                    }
                }
            }else{
                echo "<br>No se ha subido ninguna imagen";
            }
        }

        
        public function Add($codigo, $nombre, $descripcion, $stock, $precioUnitario, $minUnidades, $categorias, $paraVenta, $imagenes = null){

            if($paraVenta == "true"){
                $paraVenta = true;
            }else{
                $paraVenta = false;
            }            
            
            $this->agregarImagenes($nombre);
            $producto = new Producto('', $codigo, $nombre, $descripcion, $stock, $precioUnitario, $minUnidades, $categorias, $paraVenta);

            $this->productoDAO->Add($producto);
            $this->ShowListView();
        }


        public function Edit($id, $codigo, $nombre, $descripcion, $stock, $precioUnitario, $minUnidades, $categorias, $paraVenta, $imagenes = null){

            if($paraVenta == "true"){
                $paraVenta = true;
            }else{
                $paraVenta = false;
            }
            $this->agregarImagenes($nombre);
            $producto = new Producto($id, $codigo, $nombre, $descripcion, $stock, $precioUnitario, $minUnidades, $categorias, $paraVenta);
            $this->productoDAO->Edit($producto);
            $this->ShowListView();
        }


        public function Remove($id){

            $this->productoDAO->Remove($id);
            $this->ShowListView();
        }

        
   
        public function ShowCatalogo($categoria = null){
            
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
                $categorias = $this->categoriaDAO->GetAll();
                
                if ($categoria == null){    
                    $productos = $this->productoDAO->getProductosEnVenta(); 
                }else{
                    $productos = $this->productoDAO->getProductosPorCategoria($categoria, true);
                }

                require_once(VIEWS_PATH . 'catalogo.php');
                require_once(VIEWS_PATH . 'footer.php');

            }catch(Exception $ex){

                ToolsController::ShowErrorView("Error al obtener los productos del catalogo.", $ex->getMessage(), "/Index");
            }

    }     
}
?>
