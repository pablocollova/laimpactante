
<article>
<div id="navAdmin" class="container-fluid col-12"> 
<ul class="nav nav-pills">

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Bienvenido/a <?php echo $_SESSION['name'] ?>!</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Ver Perfil</a>
          
    <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Login/logout">Cerrar Sesi&oacute;n</a>
    </div>
  </li>

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Productos</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Producto/ShowAddView">Agregar</a>
      <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Producto/ShowListView">Listar</a>
      <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Producto/ShowCatalogo">Catálogo</a>
  </li>

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categoría</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Categoria/ShowAddView">Agregar</a>
      <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Categoria/ShowListView">Listar</a>
  </li>

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pedidos</a>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Pedido/ShowPedidoEnProcesoView">Ver pedido actual</a>
    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Pedido/ShowListaUsuarioView">Ver lista de pedidos</a>
    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Pedido/ShowListaAdminView">Administrar pedidos</a>
    </div>
  </li>


</article>
<article>
<div class="container-fluid card col-12">