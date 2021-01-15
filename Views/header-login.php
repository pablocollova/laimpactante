<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Impactante</title>
<link rel="shortcut icon" href="<?php echo LOGO ?>"/>
  
  <!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.5/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.5/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.5/dist/js/uikit-icons.min.js"></script>


<link rel="stylesheet" href="<?php echo CSS ?>" />


</head>
<body class="uk-background-muted">
<header>

<div class="uk-margin uk-margin-remove-bottom">
    <div class="uk-padding-large uk-flex uk-flex-wrap uk-flex-wrap-around uk-background-primary uk-height-medium">
    <div class="uk-width-1-3 uk-card uk-card-body uk-card-small">
    <img src="<?php echo LOGO ?>" class="card-img-top" alt="La Impactante" width="80%">
      
    </div>
    <div class="uk-width-1-2 uk-card uk-card-body uk-card-small uk-margin-left uk-margin-top uk-light">
    <h2 class="uk-h2"><b>¡S&eacute; un revendedor de La Impactante!</b></h2><br>

<a class="uk-button uk-button-secondary" href="#modal-center" uk-toggle>
Acceder
</a>

<!--<a class="js-codepen" uk-tooltip="" rel="#code-kj0h55a9" title="" aria-expanded="false"><img class="uk-icon" src="../images/icon-flask.svg" uk-svg="" hidden=""><svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="uk-icon uk-svg" data-svg="../images/icon-flask.svg">
	<line fill="none" stroke="#000" x1="5" y1="7.5" x2="12" y2="7.5"></line>
	<line fill="none" stroke="#000" x1="4" y1="1.5" x2="13" y2="1.5"></line>
	<path fill="none" stroke="#000" d="M5.078,1.5l1.433,1.868C6.952,3.93,6.948,4.839,6.646,5.48L2.147,12 c-0.418,0.962,0.028,2.5,1.353,2.5h10c1.328,0,1.777-1.538,1.359-2.5L10.4,5.479c-0.303-0.641-0.31-1.55,0.136-2.112L11.922,1.5"></path>
	<circle fill="#000" cx="10.5" cy="9.5" r="0.5"></circle>
	<circle fill="#000" cx="11.5" cy="11.5" r="0.5"></circle>
	<circle fill="#000" cx="8.5" cy="11.5" r="0.5"></circle>
</svg></a>-->

    </div>
    </div>
    </div>

    <script src="<?php echo JS_BUBBLES ?>"></script>

<!--<script src="js/jquery-1.9.1.min.js"></script>-->

</header>


<div id="modal-center" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <h2 class="uk-modal-title uk-flex uk-flex-center">Acceder</h2><hr>

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

