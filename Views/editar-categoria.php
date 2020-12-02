
<h2>Editar Categoría de Producto</h2>
<br>

<form action="<?php echo FRONT_ROOT ?>Categoria/Edit" method="post">
  <div>
    <input type="hidden" name="id" value=<?= $categoria->getId() ?> >                          
      <div>
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= $categoria->getNombre() ?>" required>
      </div>

      <div>
        <label>Descuento en porcentaje</label>
        <input type="number" name="descuento" value="<?= $categoria->getDescuento() ?>" min="0">
      </div>
  </div>
  <button type="submit" name="button">Aceptar</button>
</form>