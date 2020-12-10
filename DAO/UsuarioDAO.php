<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Usuario as Usuario;

    class UsuarioDAO{

        private $connection;
        private $tableName = "usuarios";

        public function Add(Usuario $usuario){

            try{
                $query = "INSERT INTO ".$this->tableName." (nombre_usuario, apellido_usuario, razonSocial_usuario, dni_usuario, isAdmin, email, pass_usuario, telefono_usuario, domicilio_usuario, altura_usuario, piso_usuario, dept_usuario) VALUES (:nombre, :apellido, :razonSocial, :dni, :esAdmin, :email, :pass, :telefono, :domicilio, :altura, :piso, :dpto)";
                
                $parameters["nombre"] = $usuario->getNombre();
                $parameters["apellido"] = $usuario->getApellido();
                $parameters["razonSocial"] = $usuario->getRazonSocial();
                $parameters["dni"] = $usuario->getDni();
                $parameters["esAdmin"] = $usuario->getEsAdmin();
                $parameters["email"] = $usuario->getEmail();
                $parameters["pass"] = $usuario->getPassword();
                $parameters["telefono"] = $usuario->getTelefono();
                $parameters["domicilio"] = $usuario->getCalle();
                $parameters["altura"] = $usuario->getAltura();
                $parameters["piso"] = $usuario->getPiso();
                $parameters["dpto"] = $usuario->getDpto();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            
            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetAll(){
            
            try{
                $usuarioList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){        

                    $usuario = new Usuario();
                    $usuario->setId($row["id_usuario"]);
                    $usuario->setNombre($row["nombre_usuario"]);
                    $usuario->setApellido($row["apellido_usuario"]);
                    $usuario->setEmail($row["email"]);
                    $usuario->setPassword($row["pass_usuario"]);
                    $usuario->setDni($row["dni_usuario"]);
                    $usuario->setTelefono($row["telefono_usuario"]);
                    $usuario->setCalle($row["domicilio_usuario"]);
                    $usuario->setAltura($row["altura_usuario"]);
                    $usuario->setPiso($row["piso_usuario"]);
                    $usuario->setDpto($row["dept_usuario"]);
                    $usuario->setRazonSocial($row["razonSocial_usuario"]);
                    $usuario->setEsAdmin($row["isAdmin"]);

                    //Setear la cuenta corriente
                    //Setear la lista de pedidos

                    array_push($usuarioList, $usuario);
                }
                return $usuarioList;

            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetOne($id){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_usuario = :id";
            $parameters["id"] = $id;

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

            }catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                return $this->mapear($resultSet);
            }else{
                return false;
            }
        }


        public function GetUsuarioPorPedido($idPedido){

            $query = "
            SELECT * FROM usuarios u
            INNER JOIN ventas v
            ON u.id_usuario = v.id_cliente
            WHERE id_venta = " . $idPedido;

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

            }catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                return $this->mapear($resultSet);
            }else{
                return false;
            }            
        }


        public function read($email, $pass){

            $query = "SELECT * FROM " . $this->tableName . " WHERE email = :email AND pass_usuario = :pass";
            $parameters["email"] = $email;
            $parameters["pass"] = $pass;

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

            }catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                return $this->mapear($resultSet);
            }else{
                return false;
            }
        }


        public function Edit(Usuario $usuarioActualizado){
            
            $query = "UPDATE " . $this->tableName . " SET nombre_usuario = :nombre, apellido_usuario = :apellido, razonSocial_usuario = :razonSocial, dni_usuario = :dni, isAdmin = :esAdmin, email = :email, pass_usuario = :pass, telefono_usuario = :telefono, domicilio_usuario = :domicilio, altura_usuario = :altura, piso_usuario = piso, dept_usuario = :dpto WHERE id_usuario = :id";
            $parameters["nombre"] = $usuarioActualizado->getNombre();
            $parameters["apellido"] = $usuarioActualizado->getApellido();
            $parameters["razonSocial"] = $usuarioActualizado->getRazonSocial();
            $parameters["dni"] = $usuarioActualizado->getDni();
            $parameters["esAdmin"] = $usuarioActualizado->getEsAdmin();
            $parameters["email"] = $usuarioActualizado->getEmail();
            $parameters["pass"] = $usuarioActualizado->getPassword();
            $parameters["telefono"] = $usuarioActualizado->getTelefono();
            $parameters["domicilio"] = $usuarioActualizado->getCalle();
            $parameters["altura"] = $usuarioActualizado->getAltura();
            $parameters["piso"] = $usuarioActualizado->getPiso();
            $parameters["dpto"] = $usuarioActualizado->getDpto();
            $parameters["id"] = $usuarioActualizado->getId();

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }
    
        protected function mapear($value){          //Hay que agregar la cuenta corriente
 
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Usuario($p["id_usuario"], $p["nombre_usuario"], $p["apellido_usuario"], $p["email"], $p["pass_usuario"], $p["dni_usuario"],  $p["telefono_usuario"], $p["domicilio_usuario"], $p["altura_usuario"], $p["piso_usuario"], $p["dept_usuario"], $p["razonSocial_usuario"], $p["isAdmin"]);
            }, $value);

            $pedidoDAO = new PedidoDAO();
            foreach($resp as $usuario){
                $usuario->setListaPedidos($pedidoDAO->GetPedidosPorUsuario($usuario->getId()));
            }
 
            return count($resp) > 1 ? $resp : $resp["0"];
        }
        
        
    }

?>