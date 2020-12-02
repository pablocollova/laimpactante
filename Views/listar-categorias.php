
  <h2>Listado de categorías</h2>

<br>
<div>

  <form method="post">
    <table class="table table-hover">
  
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descuento</th>
        </tr>
      </thead> 

      <tbody>
        <?php foreach ($categorias as $categoria){ ?>    
                <tr>
                  <td> <?= $categoria->getNombre(); ?> </td>
                  <td> <?= $categoria->getDescuento(); ?> </td>
                  <td>
                    <button type="submit" name='edit' class="btn btn-danger" value="<?= $categoria->getId()?>" formaction="<?= FRONT_ROOT ?> Categoria/ShowEditView"> Editar </button>
                    <button type="submit" name='remove' class="btn btn-secondary" value="<?= $categoria->getId()?>" formaction="<?=FRONT_ROOT ?> Categoria/ShowRemoveView"> Eliminar </button> 
                  </td>
                </tr>
              
        <?php } ?>
      </tbody>

    </table>
  </form> 

</div>
