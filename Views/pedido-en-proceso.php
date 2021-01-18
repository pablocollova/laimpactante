<!-- Vista de los detalles del pedido que el cliente todavía no envió -->
<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right ">
  <h2>Pedido Actual</h2>

<br>
<div> 

<table class="uk-table uk-table-middle uk-table-divider">
  
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
      <?php
          foreach ($detallesLista as $detalle){ ?>
              <tr class="filahover">
                <td> <a class="uk-link" href="<?= FRONT_ROOT ?>Producto/ShowInfo/ <?= $detalle->getProducto()->getId() ?>"> <?= $detalle->getProducto()->getNombre(); ?> </a> </td>
                <td> <?= $detalle->getCantidad(); ?> </td>
                <td> <?= $detalle->getDescuento() ?: "-"; ?> </td>
                <td>$ <?= $detalle->getImporte(); ?> </td>
                <td>

                  <a class="uk-button uk-button-danger" href="<?= FRONT_ROOT ?>Pedido/RemoveDetallePedido/ <?= $detalle->getId() ?>">Eliminar</a>

                </td>
              </tr>
            
      <?php } ?>
    </tbody>
  </table>
  
  <?php if (!empty($detallesLista)){ ?>
    <br>
    <div class="uk-flex uk-flex-center">
    <a class="uk-button uk-button-primary" href="<?= FRONT_ROOT ?>Pedido/ShowConfirmarEnvioPedidoView/ <?= $pedidoEnProceso->getId() ?>">Enviar pedido</a>     
  </div>
    <?php }?>

</div>
  </div>