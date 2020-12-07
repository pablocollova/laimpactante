<!-- Listado de productos en venta -->

<h2>CATÁLOGO</h2>

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

                  </td>
                </tr>
              
        <?php } ?>
      </tbody>

    </table>

</div>