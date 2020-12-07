
<h2>Agregar Producto</h2>
<br>

<form action="<?php echo FRONT_ROOT ?>Producto/Add" method="post" enctype="multipart/form-data">
  <div>                         
      <div>
        <label>Código</label>
        <input type="number" name="codigo" value="" min="0" required>
      </div>

      <div>
        <label>Nombre</label>
        <input type="text" name="nombre" value="" required>
      </div>

      <div>
        <label>Descripción</label>
        <textarea name="descripcion"></textarea>
      </div>

      <div>
        <label>Stock</label>
        <input type="number" name="stock" value="" min="0" required>
      </div>

      <div>
        <label>Precio Unitario</label>
        <input type="number" name="precioUnitario" value="" min="0" required>
      </div>

      <div>
        <label>Mínimo de unidades para la compra</label>
        <input type="number" name="minUnidades" value="" min="0" required>
      </div>

      <div>
        <label>Categoría</label>
        <select name="categoria" multiple required>
          <option value="" disabled selected>Seleccione una categoría</option>
          <?php
            foreach ($categorias as $categoria){
              echo "<option value=". $categoria->getNombre(). ">". $categoria->getNombre()." </option>";
            }
          ?>
        </select>
      </div>

      <fieldset>
      <legend>Producto para venta</legend>
        <input type="radio" name="paraVenta" value="true" id="true" required>
        <label for="true">Si</label>

        <input type="radio" name="paraVenta" value="false" id="false">
        <label for="false">No</label>
      </fieldset>
      
      <br>
      <div>
        <label>Seleccione imágenes del producto</label>
        <input type="file" id="imagenes" name="imagenes" accept="image/png, image/jpeg, image/jpg" multiple>

      </div>


  </div>
  <button type="submit" name="button">Agregar</button>
</form>