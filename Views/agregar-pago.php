<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right">
    <h2>Agregar Pago</h2>
    <br> 

<div>

<form action="<?php echo FRONT_ROOT.'Login/signin' ?>" method="post">
 
<div class="uk-margin-small">
        <label class="uk-form-label">Nombre</label>
        <select class="uk-select" name="nombre" required>
          <?php
            foreach ($categorias as $categoria){
              echo "<option value=". $categoria->getNombre(). ">". $categoria->getNombre()." </option>";
            }
          ?>
        </select>
      </div>

    </div>
  
  <div class="uk-flex uk-flex-center uk-margin-remove-bottom uk-margin-medium-top">
  <button type="submit" class="uk-button uk-button-primary">Agregar Pago</button>
  </div>
  
</form>

</div>

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