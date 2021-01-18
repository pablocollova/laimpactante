<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right ">
  <h2>Listado de pedidos: <?= $cliente->getNombre() . " " . $cliente->getApellido()?></h2>

<br>
<div> 

<table class="uk-table uk-table-middle uk-table-divider">
  
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Importe</th>
          <th>Descuento</th>
          <th>Nro. Remito</th>
          <th>Estado</th>
          <th>Opciones</th>
        </tr>
      </thead> 

      <tbody>
        <?php
            foreach ($pedidos as $pedido){ 
                if($pedido->getEstado() != $this->estadoPedidoDAO->getIdPorEstado("Actual")){
                
        ?>
                <tr class="filahover">
                  <td> <?= date("d/m/Y", strtotime($pedido->getFecha())); ?> </td>
                  <td> <?= $pedido->getImporte(); ?> </td>
                  <td> <?= $pedido->getDescuento(); ?> </td>
                  <td> <?= $pedido->getNroRemito(); ?> </td>
                  <td> <?= $pedido->getEstado(); ?> </td>
                  <td>
                    <a class="uk-button uk-button-primary" href="<?= FRONT_ROOT ?>Pedido/ShowDetallesUsuarioView/ <?= $pedido->getId() ?>">Ver detalles</a>
                  </td>
                </tr>
              
        <?php } } ?>
      </tbody>

    </table>

</div>
                </div>