
<h2>DETALLE DE PEDIDO</h2>
<br>

<div>

    <h5><b>Fecha:</b> <?= date("d/m/Y", strtotime($pedido->getFecha()))?> </h5>
    <h5><b>Estado:</b> <?= $pedido->getEstado()?> </h5>

    <?php
      if (!empty($pedido->getNroRemito())){ ?>

        <h5><b>Nro. Remito:</b> <?= $pedido->getNroRemito()?>
        <a href="<?= FRONT_ROOT ?>Pedido/editarNroRemito/<?= $pedido->getId() ?>" class="btn btn-warning">Editar</a>
        </h5>
        
      <?php }else{ ?>
        
        <form method= "post" action = "<?=FRONT_ROOT?>Pedido/agregarNroRemito">

          <input type="hidden" name="id" value=<?= $pedido->getId() ?> >   

          <div>
            <label><b>Agregar Nro. Remito:</b></label>
            <input type="number" name="factura" value="" min="0" required>
            <button type="submit" class="btn btn-warning"> Aceptar </button>
          </div>

        
        </form>

      <?php } ?>

    <?php
      if ($pedido->getEstado() == "Aceptado"){ 
        $venta = $this->ventaDAO->GetOne($pedido->getId());
    ?>
        <h5><b>Fecha de venta:</b> <?= date("d/m/Y", strtotime($venta->getFecha()))?> </h5>
        <h5><b>Nro. Factura:</b> <?= $venta->getNroFactura()?> </h5>
    <?php } ?>

    <h5><b>Cliente:</b> <a href="<?=FRONT_ROOT?>Usuario/perfil/<?= $cliente->getId()?>" > <?= $cliente->getNombre() . " " . $cliente->getApellido()?> </a> </h5>
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
                <td> <?= $detalle->getDescuento() ?: "-" ?> </td>
                <td>$ <?= $detalle->getImporte() ?: "-" ?> </td>
                
              </tr>
            
      <?php } ?>
    </tbody>

    <tfoot>
        <td>Totales</td>
        <td>-</td>
        <td><?= $pedido->getDescuento() ?: "-" ?></td>
        <td>$ <?= $pedido->getImporte() ?: "-" ?></td>

    </tfoot>

  </table>


  <?php 
  if ($pedido->getEstado() == "En espera"){?>
    <a href="<?= FRONT_ROOT ?>Pedido/ShowConfirmarAceptarPedidoView/<?= $pedido->getId() ?>" class="btn btn-warning">Aceptar</a>
    <a href="<?= FRONT_ROOT ?>Pedido/ShowConfirmarRechazarPedidoView/<?= $pedido->getId() ?>" class="btn btn-secondary">Rechazar</a>
  <?php } ?>
</div>



