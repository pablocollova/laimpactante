<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right">
<h2>Agregar Pago</h2>
<br>        
        <form>
        <div class="uk-margin-small">
        <label class="uk-form-label">Escribe un nombre</label>
        <input class="uk-input" type="text" id="formulario" value="">
      </div>
<br>
      <table class="uk-table uk-table-middle uk-table-divider">
  
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Opciones</th>
        </tr>
      </thead> 

      <tbody id="resultado">

</tbody>
</table>

        </form>
        </div>

        <script type ="text/javascript">

        const usuarios = <?php echo $usuariosString ?>;

        const formulario = document.querySelector('#formulario');
        const resultado = document.querySelector('#resultado');

        const filtrar = ()=>{
            resultado.innerHTML = '';

            const texto = formulario.value.toLowerCase();
            
            for(usuario of usuarios){
                let nombre = usuario.nombre.toLowerCase();

                if(nombre.indexOf(texto) !== -1){
                    resultado.innerHTML += `
                    <td>${usuario.nombre}</td>
                    <td><a class="uk-button uk-button-primary" href="<?php echo FRONT_ROOT.'Pago/AgregarPago' ?>/${usuario.id}">Agregar</a></td>
                    `
                }
            }

            if(resultado.innerHTML === ''){
                resultado.innerHTML += `
                    <td>No hay resultados.</td>
                    <td></td>
                    `
            }
        }

        formulario.addEventListener('keyup', filtrar);

    </script>