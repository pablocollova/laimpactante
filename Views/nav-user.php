<article>
<div id="navUsuario" class="container-fluid col-12"> 
<ul class="nav nav-pills">

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Bienvenido/a <?php echo $_SESSION['name'] ?>!</a>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/perfil/<?php echo $_SESSION['id'] ?>">Ver Perfil</a>
      
      <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Login/logout">Cerrar Sesi&oacute;n</a>
    </div> 
  </li>

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Productos</a>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Producto/ShowCatalogo">prductos en catalogo</a> 
  </div>
  </li>

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pedidos</a>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Pedido/ShowPedidoEnProcesoView">Ver pedido actual</a>
    <a class="dropdown-item" href="#">Ver lista de pedidos</a>
    </div>
</li>

<form class="form-inline my-2 my-lg-0 ml-auto">
      <input class="form-control mr-sm-2" type="search" name="buscar" placeholder="" aria-label="Search">
<button type="submit" class="btn btn-outline-warning my-2 my-sm-0"><i class="fa fa-search" aria-hidden="true"></i></button>

    </form>
</ul>
</div>
</article>
<article>
<div class="container-fluid card col-12">