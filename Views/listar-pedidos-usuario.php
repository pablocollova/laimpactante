
  <h2>LISTADOS DE PEDIDO DE USUARIO: <?= $cliente->getNombre() . " " . $cliente->getApellido()?></h2>

<br>
<div>

    <table class="table table-hover">
  
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
                <tr>
                  <td> <?= date("d/m/Y", strtotime($pedido->getFecha())); ?> </td>
                  <td> $ <?= $pedido->getImporte(); ?> </td>
                  <td> <?= $pedido->getDescuento() ?: "-"; ?> </td>
                  <td> <?= $pedido->getNroRemito() ?: "-"; ?> </td>
                  <td> <?= $pedido->getEstado(); ?> </td>
                  <td>
                    <a href="<?= FRONT_ROOT ?>Pedido/ShowDetallesUsuarioView/ <?= $pedido->getId() ?>">Ver detalles</a>
                  </td>
                </tr>
              
        <?php } } ?>
      </tbody>

    </table>

</div>
