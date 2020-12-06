

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Impactante</title>
<link rel="shortcut icon" href="<?php echo IMAGES.'ico.png' ?>"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo CSS_ARCH ?>" type="text/css">
<script src="https://use.fontawesome.com/b29ce011be.js"></script>

</head>
<body>

<header>
<div id="cardHeader" class="card">
  <div class="card-body">
<div id="logoP">
	<img src="<?php echo IMAGES.'logo.png' ?>" class="card-img-top" alt="La Impactante" width="100%">
    
</div>
<br>
    <h5 id="hHeader" class="card-text">S&eacute un vendedor de la impactante</h5><br>
  

<button type="button" class="btn btn-warning col-5" data-toggle="modal" data-target="#loginModal">
  Acceder
</button>

  </div>
</div>
<br>
<br>
</header>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Acceder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="login-form">
    <form action="<?php echo FRONT_ROOT.'Login/init' ?>" method="post">
       
        <div class="form-group">
        	<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-at"></span>
                    </span>                    
                </div>
                <input type="email" class="form-control" name="email" placeholder="Correo Electr&oacute;nico" required="required">				
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>                    
                </div>
                <input type="password" class="form-control" name="password" placeholder="Contrase&ntilde;a" required="required">				
            </div>
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-danger login-btn btn-block">Ingresar</button>
        </div>
        </form>
	<hr>	
       

    <br>
    <p class="text-center text-muted small">¿No tienes una cuenta? <a href="<?php echo FRONT_ROOT ?>Login/signinView">Reg&iacute;strate!</a></p>
</div>
      </div>
    </div>
  </div>
</div>


<br>
