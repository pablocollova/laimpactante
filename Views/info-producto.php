<br>
<div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin uk-margin-medium-left uk-margin-medium-right" uk-grid>
    <div class="uk-card-media-left uk-cover-container uk-background-muted">
    <div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1" uk-slideshow>

<!-- VER IMAGENES -->

<ul class="uk-slideshow-items">
<?php foreach($producto->getImagenes() as $imagen){ ?>
    <li>
        <img data-src="<?= FRONT_ROOT.$imagen?>" alt="<?= $producto->getNombre()?>" uk-cover uk-img="target: !.uk-slideshow-items" style="max-width: 350px; max-height: 350px">
    </li>
    <?php  } ?>
    <li>
        <img data-src="http://avmartinmalharro.edu.ar/dweb/4a/2019/YAROSSI/TPFLab4/images/1.jpg" alt="" uk-cover uk-img="target: !.uk-slideshow-items" style="max-width: 350px; max-height: 350px">
    </li>
    <li>
        <img data-src="http://avmartinmalharro.edu.ar/dweb/4a/2019/YAROSSI/TPFLab4/images/2.png" alt="" uk-cover uk-img="target: !.uk-slideshow-items">
    </li>
</ul>

<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

</div>
    </div>
    <div>
        <div class="uk-card-body">
           
<div>

    <h2 class=""><b><?= $producto->getNombre() ?></b>&#160;&#160;<span><small style="font-size: 13px">(C&oacute;digo: <?= $producto->getCodigo()?>)</small></span></h2>

    <h4>Información del Producto</h4>

    <table class="uk-table uk-table-divider">
    <tbody>
        <tr>
            <td><b>Descripción:</b></td>
            <td><?= $producto->getDescripcion() ?></td>
        </tr>
        <tr>
            <td><b>En stock:</b></td>
            <td><?= $producto->getStock() ?></td>
        </tr>
        <tr>
            <td><b>Precio unitario:</b></td>
            <td><?= $producto->getPrecioUnitario() ?></td>
        </tr>
        <tr>
            <td><b>Mínimo de unidades:</b></td>
            <td><?= $producto->getMinUnidades() ?></td>
        </tr>
        <tr>
            <td><b>Categoría:</b></td>
            <td><?php foreach($producto->getCategorias() as $categoria) { echo $categoria . " "; }?></td>
        </tr>
        <tr>
            <td><b>Para venta:</b></td>
            <td><?php if($producto->getParaVenta() == 1) {echo "Sí";} else {echo "No";} ?></td>
        </tr>
    </tbody>
</table>

    <!--<p><b>Descripción:</b> <?php //$producto->getDescripcion() ?></p>
    <p><b>En stock:</b> <?php //$producto->getStock() ?></p>
    <p><b>Precio unitario:</b> <?php //$producto->getPrecioUnitario() ?></p>
    <p><b>Mínimo de unidades:</b> <?php //$producto->getMinUnidades() ?></p>
    <p><b>Categoría:</b> <?php //$producto->getCategoria() ?></p>
    <p><b>Para venta:</b> <?php //if($producto->getParaVenta() == 1) {echo "Sí";} else {echo "No";} ?></p>-->
    

    <h4>Agregar al Pedido</h4>

    <form action= "<?=FRONT_ROOT?>Pedido/AddDetallePedido" method="post">

        <input type="hidden" name="id" value=<?php echo $producto->getId() ?> > 
        <div>
            <div class="uk-margin" uk-margin>
        <div uk-form-custom="target: true">
            <input class="uk-input uk-form-width-medium" type="number" placeholder="Cantidad de Unidades" name="cantidad" min="<?= $producto->getMinUnidades()?>" max="<?=$producto->getStock()?>" required>
        </div>
        <button type="submit" class="uk-button uk-button-secondary">Agregar</button>
    </div>
        </div>

    </form>

</div> 

        </div>
    </div>
</div>

 