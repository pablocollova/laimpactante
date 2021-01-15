<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right ">
  <h2>Listado de pedidos</h2>
<br>
<form class="uk-form-horizontal">
 
    <div class="uk-margin-small">
        <!--<label class="uk-form-label uk-form-width-small">Filtrar por estado</label>-->
        <select class="uk-select uk-form-width-medium" name="estado">
          <option value="" disabled selected>Seleccione un estado</option>
          <?php 
            foreach ($estados as $estado){
              echo "<option value=". $estado["id_estadopedido"]. ">". $estado["descripcion"]." </option>";
            }
          ?>
        </select>
        <button class="uk-button uk-button-default">Filtrar</button>
      </div>

          </form>

<br>
<div>

<table class="uk-table uk-table-middle uk-table-divider">
  
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Cliente</th>
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
                    
                    $cliente = $this->usuarioDAO->getUsuarioPorPedido($pedido->getId());
        ?>
                    <tr class="filahover">
                    <td> <?= $pedido->getFecha(); ?> </td>
                    <td> <?= $cliente->getNombre() . " " . $cliente->getApellido(); ?> </td>
                    <td> <?= $pedido->getImporte(); ?> </td>
                    <td> <?= $pedido->getDescuento(); ?> </td>
                    <td> <?= $pedido->getNroRemito(); ?> </td>
                    <td> <?= $pedido->getEstado(); ?> </td>
                    <td>
                        <a class="uk-button uk-button-primary" href="<?= FRONT_ROOT ?>Pedido/ShowDetallesAdminView/ <?= $pedido->getId() ?>">Ver detalles</a>
                    </td>
                    </tr>
              
        <?php } } ?>
      </tbody>

    </table>

</div>
                </div>