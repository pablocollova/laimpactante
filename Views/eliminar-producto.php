<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right">
<h2>Eliminar Producto</h2>
<h4>¿Confirma que desea eliminar el producto <?= $producto->getNombre()?>? Si hay pedidos que contienen el producto, no podr&aacute; ser eliminado.</h4>
<br>
<div class="uk-flex uk-flex-center">
    <a class="uk-button uk-button-primary" href="<?= FRONT_ROOT ?>Producto/Remove/<?= $producto->getId() ?>">Eliminar</a>
    &#160;&#160;&#160;
    <a class="uk-button uk-button-secondary" href="<?= FRONT_ROOT ?>Producto/ShowListView">Cancelar</a>
    </div>
</div>
 
 