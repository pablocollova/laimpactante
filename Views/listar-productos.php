<!-- Este listado solo lo ve el admin ya que incluye productos que no están para la venta -->
<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right ">
<h2>Listado de Productos</h2>
<br>

<form class="uk-form-horizontal">
 
    <div class="uk-margin-small">
        <!--<label class="uk-form-label uk-form-width-small">Filtrar por estado</label>-->
        <select class="uk-select uk-form-width-medium" name="estado">
          <option value="" disabled selected>Seleccione una categoría</option>
          <?php 
            foreach ($categorias as $categoria){ ?>
                <option value= "<?= $categoria->getId()?>" > <?= $categoria->getNombre()?> </option>
            <?php } ?>

            <option value= "<?= null?>"> Todos </option>
        </select>
        <button class="uk-button uk-button-default">Filtrar</button>
      </div>

</form>

<br>
<div>

<table class="uk-table uk-table-middle uk-table-divider">
  
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Nombre</th>
          <th>Precio Unitario</th>
          <th>Opciones</th>

        </tr>
      </thead> 

      <tbody>
        <?php foreach ($productos as $producto){ ?>    
                <tr class="filahover">
                  <td> <?= $producto->getCodigo(); ?> </td>
                  <td> <?= $producto->getNombre(); ?> </td>
                  <td> $ <?= $producto->getPrecioUnitario(); ?> </td>
                  <td>
                    <a class="uk-button uk-button-primary" href="<?= FRONT_ROOT ?>Producto/ShowInfo/ <?= $producto->getId() ?>">Ver</a>
                    <a class="uk-button uk-button-secondary" href="<?= FRONT_ROOT ?>Producto/ShowEditView/ <?= $producto->getId() ?>">Editar</a>
                    <a class="uk-button uk-button-danger" href="<?= FRONT_ROOT ?>Producto/ShowRemoveView/ <?= $producto->getId() ?>">Eliminar</a>
                  </td>
                </tr>
              
        <?php } ?>
      </tbody>

    </table>

</div>
        </div>