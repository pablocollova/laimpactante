<!-- Este listado solo lo ve el admin ya que incluye productos que no están para la venta -->

  <h2>Listado de productos</h2>

<br>
<div>

    <table class="table table-hover">
  
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
                <tr>
                  <td> <?= $producto->getCodigo(); ?> </td>
                  <td> <?= $producto->getNombre(); ?> </td>
                  <td> $ <?= $producto->getPrecioUnitario(); ?> </td>
                  <td>
                    <a href="<?= FRONT_ROOT ?>Producto/ShowInfo/ <?= $producto->getId() ?>">Ver</a>
                    <a href="<?= FRONT_ROOT ?>Producto/ShowEditView/ <?= $producto->getId() ?>">Editar</a>
                    <a href="<?= FRONT_ROOT ?>Producto/ShowRemoveView/ <?= $producto->getId() ?>">Eliminar</a>

                  </td>
                </tr>
              
        <?php } ?>
      </tbody>

    </table>

</div>
