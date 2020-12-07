
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

                    <a href="<?= FRONT_ROOT ?>Categoria/ShowEditView/ <?= $categoria->getId() ?>">Editar</a>
                    <a href="<?= FRONT_ROOT ?>Categoria/ShowRemoveView/ <?= $categoria->getId() ?>">Eliminar</a>

                  </td>
                </tr>
              
        <?php } ?>
      </tbody>

    </table>
  </form> 

</div>
