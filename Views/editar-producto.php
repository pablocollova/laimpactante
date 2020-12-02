
<h2>Editar Producto</h2>
<br>

<form action="<?php echo FRONT_ROOT ?>Producto/Edit" method="post">
  <div>
    <input type="hidden" name="id" value=<?= $producto->getId() ?> >                         
      <div>
        <label>Código</label>
        <input type="number" name="codigo" value="<?= $producto->getCodigo()?>" min="0" required>
      </div>

      <div>
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= $producto->getNombre()?>" required>
      </div>

      <div>
        <label>Descripción</label>
        <textarea name="descripcion"> <?= $producto->getDescripcion()?> </textarea>
      </div>

      <div>
        <label>Stock</label>
        <input type="number" name="stock" value="<?= $producto->getStock()?>" min="0" required>
      </div>

      <div>
        <label>Precio Unitario</label>
        <input type="number" name="precioUnitario" value="<?= $producto->getPrecioUnitario()?>" min="0" required>
      </div>

      <div>
        <label>Mínimo de unidades para la compra</label>
        <input type="number" name="minUnidades" value="<?= $producto->getMinUnidades()?>" min="0" required>
      </div>

      <div>
        <label>Categoría</label>
        <select name="categoria" required>
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


  </div>
  <button type="submit" name="button">Aceptar</button>
</form>