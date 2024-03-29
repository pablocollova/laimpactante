<br>

<div id="divEdit" class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right" onclick='editarProducto(<?php echo $categoriasJSON ?>, <?php echo $producto->getParaVenta() ?>);'>
<h2>Editar Producto</h2>
<br>

<form class="uk-form-horizontal" action="<?php echo FRONT_ROOT ?>Producto/Edit" method="post" enctype="multipart/form-data">

<input type="hidden" name="id" value=<?= $producto->getId() ?> > 

  <div class="uk-column-1-3">  

    <div class="uk-margin-small">
        <label class="uk-form-label">C&oacute;digo</label>
        <input class="uk-input" type="text" name="codigo" min="0" value="<?= $producto->getCodigo()?>" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Nombre</label>
        <input class="uk-input" type="text" name="nombre" value="<?= $producto->getNombre()?>" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Descripci&oacute;n</label>
        <textarea class="uk-textarea" name="descripcion"><?= $producto->getDescripcion()?></textarea>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Stock</label>
        <input class="uk-input" type="number" name="stock" value="<?= $producto->getStock()?>" min="0" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Precio Unitario</label>
        <input class="uk-input" type="text" name="precioUnitario" value="<?= $producto->getPrecioUnitario()?>" min="0" required>
      </div>
 
      <div class="uk-margin-small">
        <label class="uk-form-label">Cantidad M&iacute;nima de Unidades</label>
        <input class="uk-input" type="number" name="minUnidades" value="<?= $producto->getMinUnidades()?>" min="0" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Categor&iacute;a</label>
        <select multiple id="categorias" class="uk-select" name="categoria[]" required>
          <option value="disabled" disabled>Seleccione una categoría</option>
          <?php
            foreach ($categorias as $categoria){
              echo '<option class="categ" value="'.$categoria->getNombre().'">'.$categoria->getNombre().'</option>';
            }
          ?>
        </select>
      </div>
       
      <div class="uk-margin-small">
      <label class="uk-form-label">Producto a la Venta</label>
        <input id="ventaTrue" class="uk-radio" type="radio" name="paraVenta" value="true" id="true" required>
        <label for="true">Si</label>
            &#160;&#160;
        <input id="ventaFalse" class="uk-radio" type="radio" name="paraVenta" value="false" id="false">
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
<button type="submit" class="uk-button uk-button-primary">Aceptar</button>
          </div>
</form>
</div>

<script src="<?php echo JS ?>"></script>
<script type="text/javascript">
document.querySelector('#divEdit').click();
</script>

