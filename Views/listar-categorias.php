<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right ">
  <h2>Listado de categorías</h2>

<br>
<div>

  <form method="post">
  <table class="uk-table uk-table-middle uk-table-divider">
  
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descuento</th>
        </tr>
      </thead> 

      <tbody>
        <?php foreach ($categorias as $categoria){ ?>    
                <tr class="filahover">
                  <td> <?= $categoria->getNombre(); ?> </td>
                  <td> <?= $categoria->getDescuento(); ?>%</td>
                  <td>

                    <a class="uk-button uk-button-secondary" href="<?= FRONT_ROOT ?>Categoria/ShowEditView/ <?= $categoria->getId() ?>">Editar</a>
                    <a class="uk-button uk-button-danger" href="<?= FRONT_ROOT ?>Categoria/ShowRemoveView/ <?= $categoria->getId() ?>">Eliminar</a>

                  </td>
                </tr>
              
        <?php } ?>
      </tbody>

    </table>
  </form> 

</div>
        </div>