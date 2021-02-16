<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Categoria as Categoria;

    class CategoriaDAO{

        private $connection;
        private $tableName = "categorias";

        public function Add(Categoria $categoria){

            try{
                $query = "INSERT INTO ".$this->tableName." (nombre_categoria, descuento_categoria) VALUES (:nombre, :descuento);";
                
                $parameters["nombre"] = $categoria->getNombre();
                $parameters["descuento"] = $categoria->getDescuento();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            
            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function GetOne($id){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_categoria = :id";
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


        public function GetIDPorNombre($nombre){      //Devuelve el id de la categoría pasada por parámetro

            $query = "SELECT id_categoria FROM " . $this->tableName . " WHERE nombre_categoria = :nombre";
            $parameters["nombre"] = $nombre;

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

            }catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                return $resultSet[0]["id_categoria"];
            }else{
                return false;
            }
        }

        public function GetAll(){
            
            try{
                $categoriaList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){        

                    $categoria = new Categoria();
                    $categoria->setId($row["id_categoria"]);
                    $categoria->setNombre($row["nombre_categoria"]);
                    $categoria->setDescuento($row["descuento_categoria"]);

                    array_push($categoriaList, $categoria);
                }
                return $categoriaList;

            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function Edit(Categoria $categoria){

            try{
                $query = "UPDATE ".$this->tableName." SET nombre_categoria = :nombre, descuento_categoria = :descuento WHERE id_categoria = :id";
                
                $parameters["nombre"] = $categoria->getNombre();
                $parameters["descuento"] = $categoria->getDescuento();
                $parameters["id"] = $categoria->getId();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            
            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function Remove($id){

            $query = "DELETE FROM " . $this->tableName . " WHERE id_categoria = :id";
            $parameters["id"] = $id;

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        public function addCategoriasProducto($idProducto, $categorias){         //Agrega a la tabla de categoriaxproducto
            
            try{

                $query = "INSERT INTO categoriaxproducto (id_producto, id_categoria) VALUES (:idProducto, :idCategoria);";
                $parameters["idProducto"] = $idProducto;
                
                foreach($categorias as $categoria){
                    
                    $parameters["idCategoria"] = $this->GetIDPorNombre($categoria);
    
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
            
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function getCategoriasProducto($idProducto){
            
            $categorias = array();
            try{

                $query = "SELECT nombre_categoria FROM categoriaxproducto cxp INNER JOIN categorias c ON cxp.id_categoria = c.id_categoria WHERE id_producto = ". $idProducto;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            
                foreach ($resultSet as $row){
                    array_push($categorias, $row["nombre_categoria"]);
                }

                return $categorias;

            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function updateCategoriasProducto($idProducto, $categorias){
            
            try{
                $this->removeCategoriasProducto($idProducto);
                $this->addCategoriasProducto($idProducto, $categorias);

            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function removeCategoriasProducto($idProducto){
            
            $query = "DELETE FROM categoriaxproducto WHERE id_producto = ". $idProducto;

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }
    

        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Categoria($p["id_categoria"], $p["nombre_categoria"], $p["descuento_categoria"]);
            }, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }
        
    }

?>