<br>
    <h2>ACCEDER</h2><br> 

<div id="" class="row col-12 d-flex justify-content-center">

<form class="align-self-center" action="<?php echo FRONT_ROOT.'Login/init' ?>" method="post" style="min-width: 40%;">
        
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
            <button type="submit" class="btn btn-warning login-btn btn-block">Ingresar</button>
        </div>
        
	<hr>	
       
        <br>
        <p class="text-center text-muted small">¿No tienes una cuenta? <a href="<?php echo FRONT_ROOT ?>Login/signinView">Reg&iacute;strate!</a></p>
    </form>
    
<br>
</div>