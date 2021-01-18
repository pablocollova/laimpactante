<br>
<h2>PERFIL DE USUARIO</h2>
<br>

 <div>
        <div><br>
            <h3><?php echo $usuario->getNombre() . ' ' . $usuario->getApellido() ?></h3>
    <br>
	    <p><b>DNI:</b> <?= $usuario->getDni() ?></p>
        <p><b>Email:</b> <?= $usuario->getEmail() ?></p>
        <p><b>Teléfono:</b> <?= $usuario->getTelefono() ?></p>
        <p><b>Dirección:</b> <?= $usuario->getCalle() . " " . $usuario->getAltura() ?></p>
        <p><b>Piso:</b> <?= $usuario->getPiso() ?: "-" ?>
        <b>Dpto:</b> <?= $usuario->getDpto() ?: "-" ?></p>
        <p><b>Razón Social:</b> <?= $usuario->getRazonSocial() ?></p>

    <br>
    
    <a href="#" class="btn btn-secondary">Ver Cuenta Corriente</a>
    <a href="<?= FRONT_ROOT ?>Pedido/ShowListaUsuarioView/ <?= $usuario->getId() ?>" class="btn btn-secondary">Ver Pedidos</a>


 </div>
 <br>
 </div>