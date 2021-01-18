 
<h2>ACEPTAR PEDIDO</h2>
<br>
<h6>¿Confirma que acepta el pedido? Una vez aceptado se notificará al cliente que espere a ser contactado para acordar el pago. </h6>
<br>
<form method="post" action="<?= FRONT_ROOT ?>Pedido/aceptarPedido">

    <input type="hidden" name="id" value=<?= $id ?> >   

    <div>
        <label>Debe indicar el número de factura:</label>
        <input type="number" name="factura" value="" min="0" required>
    </div>

    <br>
    <div>
        <button type="submit" class="btn btn-danger"> Aceptar </button>
        <a href="<?= FRONT_ROOT ?>Pedido/ShowDetallesAdminView/<?= $id ?>" class="btn btn-secondary">Cancelar</a>
    </div>

</form>


