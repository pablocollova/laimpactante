
<h2>ELIMINAR PRODUCTO</h2>
<br>
<h6>¿Confirma que desea eliminar el producto <?= $producto->getNombre()?>? Si hay pedidos que contienen el producto, no podrá ser eliminado.
<br> <br>
    <a href="<?= FRONT_ROOT ?>Producto/Remove/<?= $producto->getId() ?>">Eliminar</a>
    <a href="<?= FRONT_ROOT ?>Producto/ShowListView">Cancelar</a>

