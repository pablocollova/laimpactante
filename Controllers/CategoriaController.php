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
                $categoria = $this->categoriaDAO->GetOne($id);
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
                $categoria = $this->categoriaDAO->GetOne($id);
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
            $this->categoriaDAO->Add($categoria);
            $this->ShowListView();
        }

        public function Edit($id, $nombre, $descuento){

            $categoria = new Categoria($id, $nombre, $descuento);
            $this->categoriaDAO->Edit($categoria);
            $this->ShowListView();
        }

        public function Remove($id){

            $this->categoriaDAO->Remove($id);
            $this->ShowListView();
        }     
    }

?>