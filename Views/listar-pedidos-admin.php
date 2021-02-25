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
              if($estado["descripcion"] != "Actual"){ ?>
                <option value= "<?= $estado["descripcion"]?>" > <?= $estado["descripcion"]?> </option>;
              <?php }
            }
            echo "<option value= \"todos\" > Todos </option>";
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
                    <td> <?= date("d/m/Y", strtotime($pedido->getFecha())); ?> </td>
                    <td> <?= $cliente->getNombre() . " " . $cliente->getApellido(); ?> </td>
                    <td> <?= $pedido->getImporte(); ?> </td>
                    <td> <?= $pedido->getDescuento(); ?> </td>
                    <td> <?= $pedido->getNroRemito(); ?> </td>
                    <td> 
                    <?php
                    if($pedido->getEstado() == "Actual"){
                      echo '<span class="uk-badge" style="border-radius: 2px; background-color: lightgrey; color: black;">Actual</span>';
                    }else if($pedido->getEstado() == "En Espera"){
                      echo '<span class="uk-badge" style="border-radius: 2px; background-color: #ffc107; color: black;">En Espera</span>';
                    }else if($pedido->getEstado() == "Aceptado"){
                      echo '<span class="uk-badge" style="border-radius: 2px; background-color: #28a745; color: white;">Aceptado</span>';
                    }else if($pedido->getEstado() == "Rechazado"){
                      echo '<span class="uk-badge" style="border-radius: 2px; background-color: #dc3545; color: white;">Rechazado</span>';
                    }
                    ?>
                    </td>
                    <td>
                        <a class="uk-button uk-button-primary" href="<?= FRONT_ROOT ?>Pedido/ShowDetallesAdminView/ <?= $pedido->getId() ?>">Ver detalles</a>
                    </td>
                    </tr>
              
        <?php } }?>
      </tbody>

    </table>

</div>
                </div>