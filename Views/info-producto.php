<br>
<h2>Información del producto</h2>
<br>

 <div>

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
        </div>
    </div> 
 