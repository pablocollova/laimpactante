<?php

namespace Controllers;

use \Exception as Exception;
use DAO\UsuarioDAO as UsuarioDAO;
use Models\Usuario as Usuario;

class LoginController {

    private $usuarioDAO;

    public function __construct(){

        $this->usuarioDAO = new UsuarioDAO();
    }

    public function init($email, $pass) {

        try{
            $usuario = $this->usuarioDAO->read($email, $pass);

            if ($usuario){
                
                $_SESSION['log'] = true;
                $_SESSION['id'] = $user->getId();
                $_SESSION['name'] = $user->getNombre();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['esAdmin'] = $user->getAdmin();
        
                if( $_SESSION['esAdmin'] == true){
                   //plataforma admin
                }else{
                   //plataforma cliente
                }
            }else{
    
                throw new Exception("El usuario y la contraseña no coinciden.");
    
            }
            
        }catch (Exception $ex){

            ToolsController::ShowErrorView("Error al iniciar sesión.", $ex->getMessage(), "Tools/Index/");
        }
        
    }

    public function logout() {

        session_destroy();

        session_start();

        $_SESSION['log'] = false;
        $_SESSION['esAdmin'] = false;

        $tools = new ToolsController();
        $tools->Index();

    }

    public function signinView() {

        require_once(ROOT . '/Views/header-login.php');

        require_once(ROOT . '/Views/nav-principal.php');

        require_once(ROOT . '/Views/signin.php');
        
        require_once(ROOT . '/Views/footer.php');
    
    }

    public function signin($nombre, $apellido, $dni, $email, $pass, $razonSocial,$telefono, $calle, $altura, $piso, $dpto){

        try{
            $nombre = ToolsController::validateString($nombre);
            $apellido = ToolsController::validateString($apellido);

            if (!($nombre && $apellido)){
                
                throw new Exception("El nombre o apellido está vacío.");
            }
            
            $usuario = new Usuario();
            $usuario->setNombre($nombre);
            $usuario->setApellido($apellido);
            $usuario->setDni($dni);
            $usuario->setEmail($email);
            $usuario->setPassword($pass);
            $usuario->setEsAdmin(false);
            $usuario->setTelefono($telefono);
            $usuario->setCalle($calle);
            $usuario->setAltura($altura);
            $usuario->setPiso($piso);
            $usuario->setDpto($dpto);
            $usuario->setRazonSocial($razonSocial);
            $usuario->setEsAdmin($esAdmin);
            $usuario->setCtaCorriente($ctaCorriente);
            $usuario->setListaPedidos($listaPedidos);
            /*
            nombre_usuario
            apellido_usuario
            razonSocial_usuario
            dni_usuario
            isAdmin
            email 
            pass_usuario
            telefono_usuario
            domicilio_usuario
            altura_usuario
            piso_usuario 
            dept_usuario 
            */


            $this->usuarioDAO->Add($usuario);
            $usuario = $this->usuarioDAO->read($email, $pass);
    
            $_SESSION['log'] = true;
            $_SESSION['id'] = $idUser;
            $_SESSION['name'] = $nombre;
            $_SESSION['email'] = $email;
            $_SESSION['esAdmin'] = false;
    
            $catalogo = new ProductoController();
            $catalogo->ShowCatalogo();

        }catch(Exception $ex){

          //  ToolsController::ShowErrorView("Error al agregar al usuario.", $ex->getMessage(), "Tools/Index/");
        }
    }


}