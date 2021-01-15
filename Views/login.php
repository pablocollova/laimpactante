<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right ">
    <h2 class="uk-modal-title uk-flex uk-flex-center">Acceder</h2><hr>

<div id="" class="">

<form action="<?php echo FRONT_ROOT.'Login/init' ?>" method="post">

    <div class="uk-margin uk-flex uk-flex-center">
        <div class="uk-inline uk-form-width-large">
            <span class="uk-form-icon" uk-icon="icon: mail"></span>
            <input class="uk-input uk-width-1-1" type="mail" name="email" placeholder="Correo Electr&oacute;nico" required>
        </div>
    </div>

    <div class="uk-margin uk-flex uk-flex-center">
        <div class="uk-inline uk-form-width-large">
            <span class="uk-form-icon" uk-icon="icon: lock"></span>
            <input class="uk-input uk-width-1-1" type="password" name="password" placeholder="Contrase&ntilde;a" required>
        </div>
    </div>
    <div class="uk-flex uk-flex-center">
    <button class="uk-button uk-button-primary" type="submit">Ingresar</button>
    </div>
</form>

    <p class="uk-margin uk-margin-medium-top uk-flex uk-flex-center">¿No tienes una cuenta? &#160;<a href="<?php echo FRONT_ROOT ?>Login/signinView">¡Reg&iacute;strate!</a></p>
    
</div>
</div>