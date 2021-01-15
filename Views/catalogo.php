<!-- Listado de productos en venta -->
<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right ">
<h2>Cat&aacute;logo de Productos</h2>

<br>
<div>

<table class="uk-table uk-table-middle uk-table-divider">
    <thead>
        <tr>
            <th>C&oacute;digo</th>
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

                  </td>
                </tr>
              
        <?php } ?>
    </tbody>
</table>

</div>
</div>