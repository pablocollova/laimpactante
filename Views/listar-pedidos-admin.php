
  <h2>LISTADO DE PEDIDOS</h2>

<form method="post" action="<?=FRONT_ROOT?>Pedido/ShowListaAdminView">

    <div>
        <label>Filtrar por estado: </label>
        <select name="estado" required>
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
      <button type="submit" class="btn btn-warning"> Aceptar </button>
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
                if($pedido->getEstado() !="Actual"){
                    
                    $cliente = $this->usuarioDAO->getUsuarioPorPedido($pedido->getId());
        ?>
                    <tr>
                    <td> <?= date("d/m/Y", strtotime($pedido->getFecha())); ?> </td>
                    <td> <?= $cliente->getNombre() . " " . $cliente->getApellido(); ?> </td>
                    <td>$ <?= $pedido->getImporte(); ?> </td>
                    <td> <?= $pedido->getDescuento() ?: "-"; ?> </td>
                    <td> <?= $pedido->getNroRemito() ?: "-"; ?> </td>
                    <td> <?= $pedido->getEstado(); ?> </td>
                    <td>
                    <a href="<?= FRONT_ROOT ?>Pedido/ShowDetallesAdminView/ <?= $pedido->getId() ?>">Ver detalles</a>
                    </td>
                    </tr>
              
        <?php } } ?>
      </tbody>

    </table>

</div>
