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
        <label class="uk-form-label uk-width-1-1 detalleComprador"><a href="#"> <?= $cliente->getNombre() . " " . $cliente->getApellido()?> </a></label>
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
  <div class="uk-flex uk-flex-center">
  <a class="uk-button uk-button-primary" href="#">Aceptar</a>
  &#160;&#160;&#160;
    <a class="uk-button uk-button-secondary" href="#">Rechazar</a>
</div>
</div>
</div>


