<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right">
<h2>Eliminar Categor&iacute;a</h2>
<h4>¿Confirma que desea eliminar la categor&iacute;a <?= $categoria->getNombre()?>? Si hay productos que pertenecen a esta categor&iacute;a, no podr&aacute; ser eliminada.</h4>
<br>
<div class="uk-flex uk-flex-center">
    <a class="uk-button uk-button-primary" href="<?= FRONT_ROOT ?>Categoria/Remove/<?= $categoria->getId() ?>" class="btn btn-warning">Eliminar</a>
    &#160;&#160;&#160;
    <a class="uk-button uk-button-secondary" href="<?= FRONT_ROOT ?>Categoria/ShowListView" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
 