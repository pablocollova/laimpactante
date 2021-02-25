        function filtrar(usuarios){

            const formulario = document.querySelector('#formulario');
            const resultado = document.querySelector('#resultado');

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


        function editarProducto(categoriasSelect, enVenta){

            const selectMulti = document.querySelector('#categorias');

            console.log('h'+categoriasSelect);
            console.log(enVenta);

            for(categ of selectMulti){
                for(categJson of categoriasSelect){
    
                    if(categ.value === categJson.categoria){
                        categ.setAttribute("selected", "true");
                    }

                 }
            }

            if(enVenta === 1){
                const ventaTrue = document.querySelector('#ventaTrue');
                ventaTrue.setAttribute("checked", "true");

            }else{
                const ventaFalse = document.querySelector('#ventaFalse');
                ventaFalse.setAttribute("checked", "true");

            }
        }