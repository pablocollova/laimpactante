<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right ">
    <h2 class="uk-modal-title uk-flex uk-flex-center">Registrarse</h2><hr>

<div id="" class="">

<form class="uk-grid-small" action="<?php echo FRONT_ROOT.'Login/signin' ?>" method="post" uk-grid>

        <!--nombre_usuario
            apellido_usuario
            razonSocial_usuario
            dni_usuario
            isAdmin
            email 
            pass_usuario
            telefono_usuario
            domicilio_usuario
            altura_usuario
            piso_usuario 
            dept_usuario --> 

    <div class="uk-width-1-3">
    <label class="uk-form-label" for="form-stacked-text">Nombre/s</label>
        <input class="uk-input" type="text" placeholder="" name="nombre" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
    </div>
    <div class="uk-width-1-3">
    <label class="uk-form-label" for="form-stacked-text">Apellido/s</label>
        <input class="uk-input" type="text" placeholder="" name="apellido" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
    </div>
    <div class="uk-width-1-3">
    <label class="uk-form-label" for="form-stacked-text">DNI</label>
        <input class="uk-input" type="number" placeholder="" name="dni" min="0" required>
    </div>

    <div class="uk-width-2-5">
    <label class="uk-form-label" for="form-stacked-text">Domicilio</label>
        <input class="uk-input" type="text" placeholder="" name="domicilio" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
    </div>
    <div class="uk-width-1-5">
    <label class="uk-form-label" for="form-stacked-text">N&uacute;mero</label>
        <input class="uk-input" type="number" placeholder="" name="altura" min="0" required>
    </div>
    <div class="uk-width-1-5">
    <label class="uk-form-label" for="form-stacked-text">Piso</label>
        <input class="uk-input" type="number" placeholder="" name="piso" min="0" required>
    </div>
    <div class="uk-width-1-5">
    <label class="uk-form-label" for="form-stacked-text">Depto</label>
        <input class="uk-input" type="text" placeholder="" name="dto" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
    </div>
    
    <div class="uk-width-1-2">
    <label class="uk-form-label" for="form-stacked-text">Tel&eacute;fono</label>
        <input class="uk-input" type="number" placeholder="" name="telefono" min="0" required>
    </div>
    <div class="uk-width-1-2">
    <label class="uk-form-label" for="form-stacked-text">Raz&oacute;n Social</label>
        <input class="uk-input" type="text" placeholder="" name="razonSocial" required>
    </div>
    
    <div class="uk-width-1-2">
    <label class="uk-form-label" for="form-stacked-text">Correo Electr&oacute;nico</label>
        <input class="uk-input" type="email" placeholder="" name="email" required>
    </div>
    <div class="uk-width-1-2">
    <label class="uk-form-label" for="form-stacked-text">Contrase&ntilde;a</label>
        <input class="uk-input" type="password" placeholder="" name="password" required>
    </div>
 
  </div>
  <br><br>
  <div class="uk-flex uk-flex-center">
    <button class="uk-button uk-button-primary" type="submit">Crear Cuenta</button>
  </div>
 <br>
</form>

</div>
</div>