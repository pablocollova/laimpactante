
 alert("dddfff");

document.addEventListener("DOMContentLoaded", () => {
    // El elemento que tendrá el autocompletado
    function showError(err) { alert("11");
    alert("erororo");
    console.log('muestor error', err);
  }
    const $inputNombre = document.querySelector("#nombre_usuario");

    let ac = new Awesomplete($inputNombre, {
        
        list: [], // Por defecto es una lista vacía, hasta que se comienza a escribir
        minChars: 1, // Cuántos caracteres escribir para autocompletar
       
    });
    
    // Esta función filtra los datos y refresca el autocompletado
    const refrescarLista = () => {
        let valorDelInput = $inputNombre.value;
        alert("dddfff");
        if (!valorDelInput) return; // Detener si no hay valor
        alert(valorDelInput);
        // Buscar nombres de la base de datos con PHP
        
        //aca es en el ultimo lugar donde me anda un alert...
        fetch("./auxiliar.php?busqueda=" + valorDelInput)
            .then(r => r.json().then(usuarios => {
                // Mapeamos, ya que se requiere label y value
                ac.list = usuarios.map(usuario => ({
                    label: usuario.nombre_usuario, // Lo que aparece al buscar
                    value: usuario.id, // El valor que se pone en el input
                }));
            }));
        };
    
    alert(valorDelInput);
    // Agregar un listener para cuando se cambie el contenido; en el mismo se refresca la lista
    $inputNombre.addEventListener("input", () => {
        refrescarLista();
    });

    $inputNombre.addEventListener("awesomplete-selectcomplete", function() {
        console.log("Se ha seleccionado un elemento de la lista");
    });

});