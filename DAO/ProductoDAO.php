<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Producto as Producto;
    use DAO\CategoriaDAO as CategoriaDAO;

    class ProductoDAO{

        private $connection;
        private $tableName = "productos";

        public function Add(Producto $producto){

            try{
                $query = "INSERT INTO ".$this->tableName." (codigo_producto, nombre_producto, descripcion_producto, cantidad_producto, precio_producto, categoria_producto, para_venta, minimo_unidades) VALUES (:codigo, :nombre, :descripcion, :cantidad, :precio, :categoria, :para_venta, :minimo_unidades);";
                $categoriaDAO = new CategoriaDAO();

                $parameters["codigo"] = $producto->getCodigo();
                $parameters["nombre"] = $producto->getNombre();
                $parameters["descripcion"] = $producto->getDescripcion();
                $parameters["cantidad"] = $producto->getStock();
                $parameters["precio"] = $producto->getPrecioUnitario();
                $parameters["categoria"] = $categoriaDAO->GetPorNombre($producto->getCategoria())->getId();
                $parameters["para_venta"] = $producto->getParaVenta();
                $parameters["minimo_unidades"] = $producto->getMinUnidades();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            
            }catch(Exception $ex){
                throw $ex;
            }
        }


        public function arrayImagenes($nombreProducto){

            $imagenes = array();
            $flag = true;
            $i = 0;

            while ($flag){
                $filePath = IMAGES_PATH . $nombreProducto. "-image-$i";

                if (file_exists($filePath.".jpg")){
                    array_push($imagenes, $filePath.".jpg");
                    $i++;

                } elseif (file_exists($filePath.".png")){
                    array_push($imagenes, $filePath.".png");
                    $i++;

                }elseif (file_exists($filePath.".jpeg")){
                    array_push($imagenes, $filePath.".jpeg");
                    $i++;

                }else{
                    $flag = false;
                }  
            }
            return $imagenes;
        }


        public function GetAll(){
            
            try{
                $productoList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){        

                    $producto = new Producto();
                    $producto->setId($row["id_producto"]);
                    $producto->setCodigo($row["codigo_producto"]);
                    $producto->setNombre($row["nombre_producto"]);
                    $producto->setDescripcion($row["descripcion_producto"]);
                    $producto->setStock($row["cantidad_producto"]);
                    $producto->setPrecioUnitario($row["precio_producto"]);
                    $producto->setMinUnidades($row["minimo_unidades"]);
                    $producto->setCategoria($row["categoria_producto"]);
                    $producto->setParaVenta($row["para_venta"]);
                    $producto->setImagenes($this->arrayImagenes($producto->getNombre()));

                    array_push($productoList, $producto);
                }
                return $productoList;

            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function getProductosPorCategoria($idCategoria)
        {
            
        }

        
        public function GetOne($id){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_producto = :id";
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


        public function getProductosEnVenta(){
            
            try{
                $productoList = array();

                $query = "SELECT * FROM ".$this->tableName. " WHERE para_venta = 1";

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){        

                    $producto = new Producto();
                    $producto->setId($row["id_producto"]);
                    $producto->setCodigo($row["codigo_producto"]);
                    $producto->setNombre($row["nombre_producto"]);
                    $producto->setDescripcion($row["descripcion_producto"]);
                    $producto->setStock($row["cantidad_producto"]);
                    $producto->setPrecioUnitario($row["precio_producto"]);
                    $producto->setMinUnidades($row["minimo_unidades"]);
                    $producto->setCategoria($row["categoria_producto"]);
                    $producto->setParaVenta($row["para_venta"]);

                    array_push($productoList, $producto);
                }
                return $productoList;

            }catch(Exception $ex){
                throw $ex;
            }
        }
        

        public function lastId(){

            try{
                $query = "SELECT MAX(id_producto) AS id FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            
            }catch(Exception $ex){
                throw $ex;
            }

           return $resultSet[0]['id'];
        }


        public function Remove($id){
        
            $query = "DELETE FROM " . $this->tableName . " WHERE id_producto = :id";
            $parameters["id"] = $id;
            $producto = $this->GetOne($id);
            $imagenes = $producto->getImagenes();

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
                foreach ($imagenes as $imagen){
                    unlink($imagen);
                }

            } catch (Exception $ex){ 
                throw $ex;
            }
        }


        public function getProductos()
        {
            echo "todos los productos";
        }

        public function getProductosDestacados()
        {
            echo "productos destacados";
        }

        
        public function Edit(Producto $productoActualizado){
            
            $categoriaDAO = new CategoriaDAO();
            $query = "UPDATE " . $this->tableName . " SET codigo_producto = :codigo, nombre_producto = :nombre, descripcion_producto = :descripcion, cantidad_producto = :cantidad, precio_producto = :precio, categoria_producto = :categoria, para_venta = :para_venta, minimo_unidades = :minimo_unidades WHERE id_producto = :id";
            
            $parameters["codigo"] = $productoActualizado->getCodigo();
            $parameters["nombre"] = $productoActualizado->getNombre();
            $parameters["descripcion"] = $productoActualizado->getDescripcion();
            $parameters["cantidad"] = $productoActualizado->getStock();
            $parameters["precio"] = $productoActualizado->getPrecioUnitario();
            $parameters["categoria"] = $categoriaDAO->GetPorNombre($productoActualizado->getCategoria())->getId();
            $parameters["para_venta"] = $productoActualizado->getParaVenta();
            $parameters["minimo_unidades"] = $productoActualizado->getMinUnidades();
            $parameters["id"] = $productoActualizado->getId();

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }


    
        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                
                return new Producto($p["id_producto"], $p["codigo_producto"], $p["nombre_producto"], $p["descripcion_producto"], $p["cantidad_producto"], $p["precio_producto"], $p["minimo_unidades"], $p["categoria_producto"], $p["para_venta"]);
            }, $value);
            
            $categoriaDAO = new CategoriaDAO();
            foreach($resp as $producto){
                $producto->setCategoria($categoriaDAO->GetOne($producto->getCategoria())->getNombre());
                $producto->setImagenes($this->arrayImagenes($producto->getNombre()));
            }
            return count($resp) > 1 ? $resp : $resp["0"];
        }
        
        
    }

?>