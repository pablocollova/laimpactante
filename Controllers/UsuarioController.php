<?php

namespace Controllers;

use \Exception as Exception;
use DAO\UsuarioDAO as UsersDAO;
use Models\User as User;

class UsuarioController {

    private $usersDAO;

    public function __construct(){

        $this->usersDAO = new UsersDAO();
    }

    public function perfil($id){

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

            $usuario = $this->usersDAO->GetOne($id);
            require_once(VIEWS_PATH. 'perfil-usuario.php');

        }
        require_once(VIEWS_PATH. 'footer.php');

    }

    public function ShowEditView($id) {

        try{

            require_once(ROOT . '/Views/header.php');
    
            $user = $this->usersDAO->GetOne($id);
    
            if ($_SESSION['esAdmin'] == true){
    
                require_once(ROOT . '/Views/nav-admin.php');
            
            }else{
    
                require_once(ROOT . '/Views/nav-user.php');
    
            }
    
            require_once(ROOT . '/Views/edit-user.php');
            require_once(ROOT . '/Views/footer.php');

        }catch(Exception $ex){

            ToolsController::ShowErrorView("Error al obtener la información del usuario.", $e->getMessage(), "Tools/Index/");
        }

    }

    public function Edit($id, $nombre, $apellido, $dni, $email, $pass, $admin, $idFB){

        try{
            $nombre = ToolsController::validateString($nombre);
            $apellido = ToolsController::validateString($apellido);

            if(!($nombre && $apellido)){

                throw new Exception("El nombre y/o apellido está vacío.");
            }
    
            $user = new User();
            $user->setId($id);
            $user->setNombre($nombre);
            $user->setApellido($apellido);
            $user->setDni($dni);
            $user->setEmail($email);
            $user->setPassword($pass);
            $user->setAdmin($admin);
            $user->setIdFB($idFB);
            
            $this->usersDAO->Edit($user);
    
            $_SESSION['log'] = true;
            $_SESSION['id'] = $user->getId();
            $_SESSION['name'] = $user->getNombre();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['esAdmin'] = $user->getAdmin();
    
            $this->perfil($id);

        }catch(Exception $ex){

            ToolsController::ShowErrorView("La información del usuario no pudo ser actualizada.", $e->getMessage(), "Tools/Index/");
        }

    }
}