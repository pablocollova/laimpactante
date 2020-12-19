<br>
    <h2>AGREGAR PAGO</h2><br> 

<div id="" class="row col-12 d-flex justify-content-center">

<form action="<?php echo FRONT_ROOT.'Login/signin' ?>" method="post">


<div class="form-row">
    <div class="form-group col-md-12">
      <label for="nombre">Nombre</label>
     
   

    <input type=text list=browsers class="form-control" name="nombre" placeholder="" pattern="[A-Za-z\s]+" title="Únicamente letras" required onKeyUp="buscar();">
    <datalist id=browsers >
          <option> Google
          <option> IE9
    </datalist>




    </div>
   
  </div>

 
  
  <br>
  <div class="form-group col-md-12 d-flex justify-content-center">
  <button type="submit" class="btn btn-warning col-md-12">Agregar Pago</button>
  </div>
  <br>
</form>
<br><br>
</div>
<script>

$(document).ready(function() {
    $("#resultadoBusqueda").html('<p>JQUERY VACIO</p>');
});


function buscar() {
    var textoBusqueda = $("input#busqueda").val();
	
    if (textoBusqueda != "") {
        $.post("buscar.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
        }); 
    } else { 
        ("#resultadoBusqueda").html('<p>jquery vacio</p>');
	};
};
</script>