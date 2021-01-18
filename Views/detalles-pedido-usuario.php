
<h2>DETALLE DE PEDIDO</h2>

<br>
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
                <td> <?= $detalle->getDescuento() ?: "-"; ?> </td>
                <td>$ <?= $detalle->getImporte(); ?> </td>
                
              </tr>
            
      <?php } ?>
    </tbody>
  </table>
  

</div>
