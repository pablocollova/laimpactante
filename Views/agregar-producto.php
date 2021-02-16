<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right">
<h2>Agregar Producto</h2>
<br>

<form class="uk-form-horizontal" action="<?php echo FRONT_ROOT ?>Producto/Add" method="post" enctype="multipart/form-data">
  <div class="uk-column-1-3">    

      <div class="uk-margin-small">
        <label class="uk-form-label">C&oacute;digo</label>
        <input class="uk-input" type="number" name="codigo" value="" min="0" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Nombre</label>
        <input class="uk-input" type="text" name="nombre" value="" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Descripci&oacute;n</label>
        <textarea class="uk-textarea" name="descripcion"></textarea>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Stock</label>
        <input class="uk-input" type="number" name="stock" value="" min="0" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Precio Unitario</label>
        <input class="uk-input" type="number" name="precioUnitario" value="" min="0" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Cantidad M&iacute;nima de Unidades</label>
        <input class="uk-input" type="number" name="minUnidades" value="" min="0" required>
      </div>
 
      <div class="uk-margin-small">
        <label class="uk-form-label">Categor&iacute;a</label>
        <select multiple class="uk-select" name="categoria[]" required>
          <option value="disabled" disabled selected>Seleccione una categoría</option>
          <?php
            foreach ($categorias as $categoria){
              echo "<option value=". $categoria->getNombre(). ">". $categoria->getNombre()." </option>";
            }
          ?>
        </select>
      </div>

      <div class="uk-margin-medium">
      <label class="uk-form-label">Producto a la Venta</label>
        <input class="uk-radio" type="radio" name="paraVenta" value="true" id="true" required>
        <label for="true">Si</label>
            &#160;&#160;
        <input class="uk-radio" type="radio" name="paraVenta" value="false" id="false">
        <label for="false">No</label>
      </div>
      
      
      <div class="uk-margin-small">
        <label class="uk-form-label">Subir Im&aacute;genes</label>
        <div class="uk-margin">
        <div uk-form-custom>
            <input type="file" name="imagenes[]" accept="image/jpg, image/png, image/jpeg" multiple>
            <button class="uk-button uk-button-default" type="button" tabindex="-1">Seleccionar</button>
        </div>
    </div>
      </div>


  </div>
<br>
<br>
<div class="uk-flex uk-flex-center">
<button type="submit" class="uk-button uk-button-primary">Agregar</button>
          </div>
</form>

          </div>