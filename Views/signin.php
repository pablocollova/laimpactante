<br>
    <h2>REGISTRARSE</h2><br> 

<div id="" class="row col-12 d-flex justify-content-center">

<form action="<?php echo FRONT_ROOT.'Login/signin' ?>" method="post">

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

<div class="form-row">
    <div class="form-group col-md-4">
      <label for="nombre">Nombre</label>
      <!-- El atributo pattern indica que solo se aceptan letras y espacios -->
      <input type="text" class="form-control" name="nombre" placeholder="" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
    </div>
    <div class="form-group col-md-4">
      <label for="apellido">Apellido</label>
      <input type="text" class="form-control" name="apellido" placeholder="" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
    </div>
    <div class="form-group col-md-4">
      <label for="dni">DNI</label>
      <input type="number" class="form-control" name="dni" placeholder="" min="0" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="domicilio">Domicilio</label>
      <input type="Text" class="form-control" name="domicilio" placeholder="" min="0" required>
    </div>
    <div class="form-group col-md-2 ">
      <label for="altura">Nro</label>
      <input type="number" class="form-control" name="altura" placeholder="" min="0" required>
    </div>
    <div class="form-group col-md-1">
      <label for="piso">Piso</label>
      <input type="number" class="form-control" name="piso" placeholder="" min="0">
    </div>
    <div class="form-group col-md-1">
      <label for="dto">Dto</label>
      <input type="number" class="form-control" name="dto" placeholder="" min="0">
    </div>
    <div class="form-group col-md-4">
      <label for="telefono">Telefono</label>
      <input type="number" class="form-control" name="telefono" placeholder="" min="0" required>
    </div>
  </div>
  
  
  <div class="form-row">
  <div class="form-group col-md-4">
      <label for="razonSocial">Razon Social</label>
      <input type="text" class="form-control" name="razonSocial" placeholder="" required>
    </div>
    <div class="form-group col-md-4">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" placeholder="" required>
    </div>
    <div class="form-group col-md-4">
      <label for="password">Contrase&ntilde;a</label>
      <input type="password" class="form-control" name="password" placeholder="" required>
    </div>
    
  </div>
  <br>
  <div class="form-group col-md-12 d-flex justify-content-center">
  <button type="submit" class="btn btn-warning col-md-4">Crear Cuenta</button>
  </div>
  <br>
</form>
<br><br>
</div>