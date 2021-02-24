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
                $_SESSION['id'] = $usuario->getId();
                $_SESSION['name'] = $usuario->getNombre();
                $_SESSION['email'] = $usuario->getEmail();
                $_SESSION['esAdmin'] = $usuario->getEsAdmin();
        
                $catalogo = new ProductoController();
                $catalogo->ShowCatalogo();
                
            }else{
    
                throw new Exception("El usuario y la contraseña no coinciden.");
    
            }
            
        }catch (Exception $ex){

            ToolsController::ShowErrorView("El usuario y la contraseña no coinciden.", "Producto/ShowCatalogo/");
        }
    }


    public function logout() {

        session_destroy();

        session_start();

        $_SESSION['log'] = false;
        $_SESSION['esAdmin'] = false;

        $catalogo = new ProductoController();
        $catalogo->ShowCatalogo();
    }


    public function signinView() {

        require_once(ROOT . '/Views/header-login.php');

        require_once(ROOT . '/Views/nav-principal.php');

        require_once(ROOT . '/Views/signin.php');
        
        require_once(ROOT . '/Views/footer.php');
    
    }


    public function signin($nombre, $apellido, $dni, $calle, $altura, $piso, $dpto, $telefono, $razonSocial, $email, $pass){

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
            $usuario->setEsAdmin(false);
            $usuario->setCtaCorriente(array());
            $usuario->setListaPedidos(array());

            $this->usuarioDAO->Add($usuario);
            $usuario = $this->usuarioDAO->read($email, $pass);
    
            $_SESSION['log'] = true;
            $_SESSION['id'] = $usuario->getId();
            $_SESSION['name'] = $nombre;
            $_SESSION['email'] = $email;
            $_SESSION['esAdmin'] = false;
    
            $catalogo = new ProductoController();
            $catalogo->ShowCatalogo();

        }catch(Exception $ex){

          ToolsController::ShowErrorView("No se pudo agregar al usuario, revise que los datos sean válidos.", "Login/signinView/");
        }
    }


}