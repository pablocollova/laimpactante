<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right">
    <h2>Editar Perfil</h2><br> 

<div id="" class="">

<form class="uk-form-horizontal" action="<?php echo FRONT_ROOT.'User/Edit/' ?>" method="post">
<div class="uk-column-1-2">

      <div class="uk-margin-small">
        <label class="uk-form-label">Nombre</label>
        <input class="uk-input" type="text" name="nombre" value="<?php echo $user->getNombre() ?>" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Apellido</label>
        <input class="uk-input" type="text" name="apellido" value="<?php echo $user->getApellido() ?>" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">DNI</label>
        <input class="uk-input" type="number" name="dni" value="<?php echo $user->getDni() ?>" min="0" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Email</label>
        <input class="uk-input" type="email" name="email" value="<?php echo $user->getEmail() ?>" required>
      </div>

      <div class="uk-margin-small">
        <label class="uk-form-label">Contrase&ntilde;a</label>
        <input class="uk-input" type="password" name="password" value="<?php echo $user->getPassword() ?>" required>
      </div>

  <input type="hidden" name="esAdmin" value=<?php echo $user->getEsAdmin() ?> > 
  <input type="hidden" name="id" value=<?php echo $user->getId() ?> > 

  
  </div>

  <div class="uk-flex uk-flex-center uk-margin-remove-bottom uk-margin-medium-top">
<button type="submit" class="uk-button uk-button-primary">Guardar Cambios</button>
          </div>
  <br>
</form>

</div>
</div>