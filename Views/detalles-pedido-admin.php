
<h2>DETALLE DE PEDIDO</h2>
<br>

<div>

    <h5><b>Estado del pedido:</b> <?= $pedido->getEstado()?> </h5>
    <h5><b>Cliente:</b> <a href="#"> <?= $cliente->getNombre() . " " . $cliente->getApellido()?> </a> </h5>
    <br>
    <p><b>DNI:</b> <?= $cliente->getDni() ?></p>
    <p><b>Razon Social:</b> <?= $cliente->getRazonSocial() ?></p>

</div>

<div>

  <table class="table table-hover">
  
    <thead>
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Descuento</th>
        <th>Importe</th>

      </tr>
    </thead> 

    <tbody>
      <?php
          foreach ($detalles as $detalle){ ?>    
              <tr>
                <td> <a href="<?= FRONT_ROOT ?>Producto/ShowInfo/ <?= $detalle->getProducto()->getId() ?>"> <?= $detalle->getProducto()->getNombre(); ?> </a> </td>
                <td> <?= $detalle->getCantidad(); ?> </td>
                <td> <?= $detalle->getDescuento(); ?> </td>
                <td>$ <?= $detalle->getImporte(); ?> </td>
                
              </tr>
            
      <?php } ?>
    </tbody>

    <tfoot>
        <td>Totales</td>
        <td>-</td>
        <td><?= $pedido->getDescuento() ?></td>
        <td>$ <?= $pedido->getImporte() ?></td>

    </tfoot>

  </table>

  <a href="#" class="btn btn-warning">Aceptar</a>
    <a href="#" class="btn btn-secondary">Rechazar</a>

</div>



