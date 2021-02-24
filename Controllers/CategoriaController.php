<?php

    namespace Controllers;

    use \Exception as Exception;
    use DAO\CategoriaDAO as CategoriaDAO;
    use Models\Categoria as Categoria;

    class CategoriaController{

        private $categoriaDAO;

        public function __construct(){

            $this->categoriaDAO = new CategoriaDAO();
        }


        public function ShowAddView(){
            
            if ($_SESSION['esAdmin'] == true){
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');
                require_once(VIEWS_PATH. 'agregar-categoria.php');
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

                try{
                    $categoria = $this->categoriaDAO->GetOne($id);
                }catch (Exception $e){
                    ToolsController::ShowErrorView("No se pudo cargar la categoría.", "Categoria/ShowListView/");
                }

                require_once(VIEWS_PATH. 'editar-categoria.php');
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
                $categorias = $this->categoriaDAO->GetAll();
                require_once(VIEWS_PATH. 'listar-categorias.php');
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
                try{
                    $categoria = $this->categoriaDAO->GetOne($id);
                }catch (Exception $e){
                    ToolsController::ShowErrorView("No se pudo borrar la categoría.", "Categoria/ShowListView/");
                }
                require_once(VIEWS_PATH. 'eliminar-categoria.php');
            }else{
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }
            require_once(VIEWS_PATH . 'footer.php');
        }


        public function Add($nombre, $descuento){

            $categoria = new Categoria('', $nombre, $descuento);
            try{
                $this->categoriaDAO->Add($categoria);
            }catch (Exception $e){
                ToolsController::ShowErrorView("No se pudo agregar la categoría.", "Categoria/ShowListView/");
            }
            $this->ShowListView();
        }

        public function Edit($id, $nombre, $descuento){

            $categoria = new Categoria($id, $nombre, $descuento);
            try{
                $this->categoriaDAO->Edit($categoria);
            }catch (Exception $e){
                ToolsController::ShowErrorView("No se pudo editar la categoría.", "Categoria/ShowListView/");
            }
            $this->ShowListView();
        }

        public function Remove($id){

            try{
                $this->categoriaDAO->Remove($id);
            }catch (Exception $e){
                ToolsController::ShowErrorView("No se pudo eliminar la categoría.", "Categoria/ShowListView/");
            }
            $this->ShowListView();
        }     
    }

?>