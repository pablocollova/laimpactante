<br>

<div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-medium-left uk-margin-medium-right">
<h2>Agregar Pago</h2>
<br>        
        <form>
        <div class="uk-margin-small">
        <label class="uk-form-label">Escribe un nombre</label>
        <input class="uk-input" type="text" id="formulario" value="" onkeyup='filtrar(<?php echo $usuariosString ?>);'>
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

        <script src="<?php echo JS ?>"></script>