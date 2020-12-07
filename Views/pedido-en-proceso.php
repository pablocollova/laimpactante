<!-- Vista de los detalles del pedido que el cliente todavía no envió -->

<h2>Pedido Actual</h2>

<br>
<div>

    <table class="table table-hover">
  
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Descuento</th>
          <th>Importe</th>
          <th>Opciones</th>

        </tr>
      </thead> 

      <tbody>
        <?php foreach ($detallesLista as $detalle){ ?>    
                <tr>
                  <td> <a href="<?= FRONT_ROOT ?>Producto/ShowInfo/ <?= $detalle->getProducto()->getId() ?>"> <?= $detalle->getProducto()->getNombre(); ?> </a> </td>
                  <td> <?= $detalle->getCantidad(); ?> </td>
                  <td> <?= $detalle->getDescuento(); ?> </td>
                  <td> <?= $detalle->getImporte(); ?> </td>
                  <td>

                    <a href="#">Editar</a>
                    <a href="#">Eliminar</a>

                  </td>
                </tr>
              
        <?php } ?>
      </tbody>

    </table>
  </form> 

</div>
