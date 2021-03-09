<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right">
<h2>Agregar Pago</h2>
<br>

<form class="uk-form-horizontal" action="<?php echo FRONT_ROOT ?>Pago/Add" method="post" enctype="multipart/form-data">
  <div class="uk-column-1-3">    

      <div class="uk-margin-small">
        <label class="uk-form-label">Cliente</label>
        <label class="uk-form-label"><?php  echo $userActual->getNombre().' '.$userActual->getApellido() ?></label>
        <input class="uk-input" type="hidden" name="idCliente" value="<?php echo $userActual->getId() ?>"  >
        </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Monto a pagar</label>
        <input class="uk-input" type="text" name="monto" value="" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">nro Factura</label>
        <input class="uk-input" type="text" name="nroFactura" value="" required>
      </div>
      <div class="uk-margin-small">
        <label class="uk-form-label">fecha</label>
        <input class="uk-input" type="text" name="fecha" value="" required>
      </div>
      <div class="uk-margin-small">
        <label class="uk-form-label">medio de pago</label>
        <input class="uk-input" type="text" name="medioDePAgo" value="" required>
      </div>
      <div class="uk-margin-small">
        <label class="uk-form-label">nro Recibo</label>
        <input class="uk-input" type="text" name="nroRecibo" value="" required>
      </div>

  </div>
<br>
<br>
<div class="uk-flex uk-flex-center">
<button type="submit" class="uk-button uk-button-primary">Agregar</button>
          </div>
</form>

          </div>                                                                                                     