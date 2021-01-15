<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right">
<h2>Editar Categor&iacute;a de Producto</h2>
<br>
 
<form class="uk-form-horizontal" action="<?php echo FRONT_ROOT ?>Categoria/Edit" method="post">
    <input type="hidden" name="id" value=<?= $categoria->getId() ?> >      

    <div class="uk-column-1-2">  

    <div class="uk-margin-small">
    <label class="uk-form-label" for="form-stacked-text">Nombre</label>
        <input class="uk-input" type="text" placeholder="" name="nombre" value="<?= $categoria->getNombre() ?>" required>
    </div>
    <div class="uk-margin-small">
    <label class="uk-form-label" for="form-stacked-text">Descuento en porcentaje</label>
        <input class="uk-input" type="number" placeholder="" name="descuento" value="<?= $categoria->getDescuento() ?>" min="0" required>
    </div>
</div>

<div class="uk-flex uk-flex-center uk-margin-remove-bottom uk-margin-medium-top">
<button type="submit" class="uk-button uk-button-primary">Aceptar</button>
          </div>
</form>
</div>
</div>