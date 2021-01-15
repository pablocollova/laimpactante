<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right">
<h2>Agregar Categor&iacute;a de Producto</h2>
<br>

<form class="uk-form-horizontal" action="<?php echo FRONT_ROOT ?>Categoria/Add" method="post">
  <div class="uk-column-1-2">   

  <div class="uk-margin-small">
        <label class="uk-form-label">Nombre</label>
        <input class="uk-input" type="text" name="nombre" value="" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Porcentaje de Descuento</label>
        <input class="uk-input" type="number" name="descuento" value="" min="0" max="100" required>
      </div>  

  </div>
  <br>
<br>
<div class="uk-flex uk-flex-center">
<button type="submit" class="uk-button uk-button-primary">Agregar</button>
          </div>
</form>
</div>