
<h2>Agregar Categoría de Producto</h2>
<br>

<form action="<?php echo FRONT_ROOT ?>Categoria/Add" method="post">
  <div>                         
      <div>
        <label>Nombre</label>
        <input type="text" name="nombre" value="" required>
      </div>

      <div>
        <label>Descuento en porcentaje</label>
        <input type="number" name="descuento" value="" min="0" max="100">
      </div>
  </div>
  <button type="submit" name="button">Agregar</button>
</form>