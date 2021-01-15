<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right ">
<h2>Datos Personales</h2>

 <div class="">
            <h3 class="uk-card-title"><?php echo $user->getNombre() . ' ' . $user->getApellido() ?></h3>

            <table class="uk-table uk-table-divider">
    <tbody>
        <tr>
            <td><b>DNI:</b></td>
            <td><?php echo $user->getDni() ?></td>
        </tr>
        <tr>
            <td><b>Email:</b></td>
            <td><?php echo $user->getEmail() ?></td>
        </tr>
        <tr>
            <td><b>Contrase&ntilde;a:</b></td>
            <td><?php $cant = strlen($user->getPassword()); for($i=0;$i<$cant;$i++){ echo '*'; } ?></td>
        </tr>
</tbody>
</table>
   
        <br>
      <a class="uk-button uk-button-primary" href="#"><span class="uk-margin-small-right" uk-icon="cart"></span>Mis Pedidos</a>
    <a class="uk-button uk-button-secondary" href="<?php echo FRONT_ROOT ?>Usuario/ShowEditView/<?php echo $_SESSION['id'] ?>"><span class="uk-margin-small-right" uk-icon="pencil"></span>Editar Perfil</a>
 </div>
 
 </div>
</div>

