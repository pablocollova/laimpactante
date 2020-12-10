
  <h2>Listado de pedidos</h2>

<form>

    <div>
        <label>Filtrar por estado</label>
        <select name="estado">
          <option value="" disabled selected>Seleccione un estado</option>
          <?php
            foreach ($estados as $estado){
              echo "<option value=". $estado["id_estadopedido"]. ">". $estado["descripcion"]." </option>";
            }
          ?>
        </select>
      </div>

<form>

<br>
<div>

    <table class="table table-hover">
  
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
                    <tr>
                    <td> <?= $pedido->getFecha(); ?> </td>
                    <td> <?= $cliente->getNombre() . " " . $cliente->getApellido(); ?> </td>
                    <td> <?= $pedido->getImporte(); ?> </td>
                    <td> <?= $pedido->getDescuento(); ?> </td>
                    <td> <?= $pedido->getNroRemito(); ?> </td>
                    <td> <?= $pedido->getEstado(); ?> </td>
                    <td>
                        <a href="<?= FRONT_ROOT ?>Pedido/ShowDetallesAdminView/ <?= $pedido->getId() ?>">Ver detalles</a>
                    </td>
                    </tr>
              
        <?php } } ?>
      </tbody>

    </table>

</div>
