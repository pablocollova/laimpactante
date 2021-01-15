<article>

<nav class="uk-navbar uk-background-secondary uk-light uk-margin" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav uk-padding-large uk-padding-remove-bottom uk-padding-remove-top uk-padding-remove-right">
            <li>
                <a href="#">Bienvenido/a <?php echo $_SESSION['name'] ?>!</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="<?php echo FRONT_ROOT ?>Usuario/perfil/<?php echo $_SESSION['id'] ?>">Ver Perfil</a></li>
                        <li><a href="<?php echo FRONT_ROOT ?>Login/logout">Cerrar Sesi&oacute;n</a></li>

                    </ul>
                </div>
            </li>

            <li>
                <a href="#">Productos</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="<?php echo FRONT_ROOT ?>Producto/ShowAddView">Agregar Producto</a></li>
                        <li><a href="<?php echo FRONT_ROOT ?>Producto/ShowListView">Listar Productos</a></li>
                        <li><a href="<?php echo FRONT_ROOT ?>Producto/ShowCatalogo">Cat&aacute;logo de Productos</a></li>
                        
                    </ul>
                </div>
            </li>

            <li>
                <a href="#">Pedidos</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="<?php echo FRONT_ROOT ?>Pedido/ShowPedidoEnProcesoView">Ver Pedido Actual</a></li>
                        <li><a href="<?php echo FRONT_ROOT ?>Pedido/ShowListaUsuarioView">Ver Lista de Pedidos</a></li>
                        <li><a href="<?php echo FRONT_ROOT ?>Pedido/ShowListaAdminView">Administrar Pedidos</a></li>

                    </ul>
                </div>
            </li>

            <li>
                <a href="#">Categor&iacute;as</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="<?php echo FRONT_ROOT ?>Categoria/ShowAddView">Agregar Categor&iacute;a</a></li>
                        <li><a href="<?php echo FRONT_ROOT ?>Categoria/ShowListView">Listar Categor&iacute;as</a></li>
                  
                     </ul>
                </div>
            </li>

            <li>
                <a href="#">Pagos</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="<?php echo FRONT_ROOT ?>Pago/ShowAddView">Agregar Pago</a></li>
                        <li><a href="<?php echo FRONT_ROOT ?>Pago/ShowListView">Listar Pagos</a></li>
                  
                    </ul>
                </div>
            </li>

         </ul>
    </div>
</nav>

</article>
<article>
<div class="uk-background-muted uk-margin-remove-top uk-margin-remove-bottom">

  
