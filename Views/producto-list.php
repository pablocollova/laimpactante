<div>
  <main class="hoc container clear"> 
    <!-- main body -->
    <div>
<br>
    <h2>LISTADO DE PRODUCTOS</h2>
<br>
      <div>

      <form method="post">
      <?php foreach ($productos as $producto){
        ?>
      <h5><?php echo $producto->getNombre(); ?></h5><br>
      <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">CodProd</th>
      <th scope="col">Precio</th>
      <th scope="col">Stock</th>
    
    </tr>
  </thead>
  <tbody>   
  <?php 
        $productoList = $this->productoDAO->getProductosPorCategoria($idCategoria);
        foreach ($productoList as $producto){ 
    ?>
            <tr>
              <td> <?php echo producto->getNombre(); ?> </td>
            
              <td>
                <button type="submit" name='edit' class="btn btn-danger" value="<?php echo $funcion->getId(); ?>" formaction="<?php FRONT_ROOT ?>../Funcion/ShowEditView"> Editar </button>
                <button type="submit" name='remove' class="btn btn-secondary" value="<?php echo $funcion->getId(); ?>" formaction="<?php FRONT_ROOT ?>../Funcion/ShowRemoveView"> Eliminar </button> 
              </td>
            </tr>

            <?php } ?>
  </tbody>
</table>
<hr><br>
<?php } ?><br>
</form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
