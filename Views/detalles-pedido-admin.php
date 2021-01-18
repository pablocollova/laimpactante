<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right ">
<h2>Detalle de Pedido</h2>
<br>

<form class="uk-form-horizontal">
<div class="uk-column-1-2">
    <div class="uk-margin">
        <label class="uk-form-label uk-width-1-1 detalleComprador"><b>Estado del pedido:</b></label>
        <div class="uk-form-controls uk-width-1-1">
        <div class="uk-inline">
        <label class="uk-form-label uk-width-1-1 detalleComprador"><?= $pedido->getEstado()?></label>
            </div>
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label uk-width-1-1 detalleComprador"><b>Cliente:</b></label>
        <div class="uk-form-controls uk-width-1-1">
        <div class="uk-inline">
        <label class="uk-form-label uk-width-1-1 detalleComprador"><a href="<?=FRONT_ROOT?>Usuario/perfil/<?= $cliente->getId()?>"> <?= $cliente->getNombre() . " " . $cliente->getApellido()?> </a></label>
            </div>
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label uk-width-1-1 detalleComprador"><b>DNI:</b></label>
        <div class="uk-form-controls uk-width-1-1">
        <div class="uk-inline">
        <label class="uk-form-label uk-width-1-1 detalleComprador"><?= $cliente->getDni() ?></label>
            </div>
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label uk-width-1-1 detalleComprador"><b>Raz&oacute;n Social:</b></label>
        <div class="uk-form-controls uk-width-1-1">
        <div class="uk-inline">
        <label class="uk-form-label uk-width-1-1 detalleComprador"><?= $cliente->getRazonSocial() ?></label>
            </div>
        </div>


    </div>
  </div>
  </form>

  <!-- ////////////////////////////////////////////////////////// -->

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

  <!-- ////////////////////////////////////////////////////////// -->



<br>
<br>


<div>

  <table class="uk-table uk-table-middle uk-table-divider">
  
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
              <tr class="filahover">
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
  <br>
  <?php 
  if ($pedido->getEstado() == "En espera"){?>
   
    <div class="uk-flex uk-flex-center">
      <a class="uk-button uk-button-primary" href="<?= FRONT_ROOT ?>Pedido/ShowConfirmarAceptarPedidoView/<?= $pedido->getId() ?>">Aceptar</a>
      &#160;&#160;&#160;
      <a class="uk-button uk-button-secondary" href="<?= FRONT_ROOT ?>Pedido/ShowConfirmarRechazarPedidoView/<?= $pedido->getId() ?>">Rechazar</a>
    </div>

  <?php } ?>
</div>
</div>


