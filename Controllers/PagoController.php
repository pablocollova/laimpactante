<?php

    namespace Controllers;

    use \Exception as Exception;
    use DAO\PagoDAO as PagoDAO;
    use DAO\UsuarioDAO as UsuarioDAO;
    use Models\Pago as Pago;
    use Models\Usuario as Usuario;

    class PagoController{
        private $PagoDAO;

        private $usuariosDAO;

        public function __construct(){
            $this->pagoDAO = new PagoDAO();

            $this->usuariosDAO = new UsuarioDAO();
        }

        public function ShowAddView(){
            
            if ($_SESSION['esAdmin'] == true){

                $usuarios = $this->usuariosDAO->GetAll();

                $usuariosString = '[';

               foreach($usuarios as $usuario){
                    $usuariosString = $usuariosString . '{"nombre":"' .$usuario->getNombre(). '","id":"' .$usuario->getId(). '"},';
               }

               $usuariosString = substr($usuariosString, 0, -1);

               $usuariosString = $usuariosString . ']';
                
                require_once(VIEWS_PATH. 'header.php');
                require_once(VIEWS_PATH. 'nav-admin.php');
                require_once(VIEWS_PATH. 'agregar-pago-filtro.php');

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
                $pago = $this->pagoDAO->GetOne($id);
                require_once(VIEWS_PATH. 'editar-pago.php');
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
                $categorias = $this->pagoDAO->GetAll();
                require_once(VIEWS_PATH. 'listar-pagos.php');
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
                $categoria = $this->pagoDAO->GetOne($id);
                require_once(VIEWS_PATH. 'eliminar-pago.php');
            }else{
                require_once(VIEWS_PATH. 'header-login.php');
                require_once(VIEWS_PATH. 'nav-principal.php');
                require_once(VIEWS_PATH. 'login.php');
            }
            require_once(VIEWS_PATH . 'footer.php');
        }
        public function Add($fecha, $monto , $medioDePago , $listaDetalles , $nroRecibo,$idCliente){
            
           
            $pago = new Pago('',$fecha,$monto,$medioDePago,$listaDetalles,$nroRecibo,$idCliente);
            $this->pagoDAO->Add($pago, idClinete);
            $this->ShowListView();
        }

        public function Edit($fecha, $monto , $medioDePago , $listaDetalles , $nroRecibo,$idCliente){
            
           
            $pago = new Pago('',$fecha,$monto,$medioDePago,$listaDetalles,$nroRecibo,$idCliente);
            $this->pagoDAO->Edit($pago, idClinete);
            $this->ShowListView();
        }

      

        public function Remove($id){

            $this->pagoDAO->Remove($id);
            $this->ShowListView();
        }     
    

    public function AgregarPago($id_user){

       $usu= $this->usuariosDAO->GetOne($id_user);
       $_SESSION['filtroPago'] = true;
       echo $usu->getNombre();
        echo $id_user;
    }

   

}

?>