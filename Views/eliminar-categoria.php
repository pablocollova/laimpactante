
    <h6>¿Confirma que desea eliminar la categoría <?= $categoria->getNombre()?>? Si hay productos que pertenecen a esta categoría, no podrá ser eliminada.
    <br>
        <a href="<?= FRONT_ROOT ?>Categoria/Remove/<?php echo $categoria->getId() ?>" class="btn btn-danger">Eliminar</a>
        <a href="<?= FRONT_ROOT ?>Categoria/ShowListView" class="btn btn-secondary">Cancelar</a>

