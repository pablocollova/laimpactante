<br>
<h2>Información del producto</h2>
<br>

<div>
    <?php foreach($producto->getImagenes() as $imagen){ ?>

    <img src= "<?= FRONT_ROOT.$imagen?>" alt= "<?= $producto->getNombre()?>" style="width:128px;height:128px;"> 

    <?php } ?>

    <h3><?= $producto->getNombre() ?></h3>
    <h5><?= $producto->getCodigo()?></h5>
    <br>
    <p><b>Descripción</b> <?= $producto->getDescripcion() ?></p>
    <p><b>Stock</b> <?= $producto->getStock() ?></p>
    <p><b>Precio Unitario</b> <?= $producto->getPrecioUnitario() ?></p>
    <p><b>Mínimo de unidades</b> <?= $producto->getMinUnidades() ?></p>
    <p><b>Categoría</b> <?= $producto->getCategoria() ?></p>
    <p><b>Para venta</b> <?= $producto->getParaVenta() ?></p>
    <br>

    <h4>Agregar al pedido</h4>

    <form action= "<?=FRONT_ROOT?>Pedido/AddDetallePedido" method="post">

        <input type="hidden" name="id" value=<?php echo $producto->getId() ?> > 
        <div>
            <label>Cantidad de Unidades</label>
            <input type="number" name="cantidad" min=<?= $producto->getMinUnidades()?> max="<?= $producto->getStock()?>" required>
            <button type="submit" name="button">Agregar</button>
        </div>

    </form>

</div> 
 