<?php 

include('../includes/adodb5/adodb.inc.php');
include('../includes/ConexionAdodb.class.php');

$id_usuario=$userAuthentication->getUserId();
$Qry_identificar="SELECT usuario,id_perfil,nombre FROM usuarios WHERE id=$id_usuario";
$Qry_identificarEx=$dbmysql->Execute($Qry_identificar);
 ?>
<nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li><a href="../sitio/index.php"><span class="glyphicon glyphicon-home"> </span> Principal</a></li>
      <?php if ($userAuthentication->isAuthenticated()) : ?>
        <li><a href="../usuario/miperfil.php"><span class="glyphicon glyphicon-user"></span> Mi panel de control</a></li>
      <?php else : ?>
      <li><a href="../nuevousuario/nuevousuario1.php"><span class="glyphicon glyphicon-user"></span> Registro de usuarios</a></li>
    <?php endif; ?>
      <!--<li><a href="#">Busqueda de Viviendas</a></li>
       <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Menú #1 <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Acción #1</a></li>
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #4</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #5</a></li>
        </ul>
      </li>
      <li><a href="#">Enlace #3</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Menú #2 <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Acción #1</a></li>
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #4</a></li>
        </ul>
      </li> -->
    </ul> 
 
    
 
    <ul class="nav navbar-nav navbar-right">

<?php 

if (!$userAuthentication->isAuthenticated()) {
  echo '
    <form method="post" action="../sitio/index.php" class="navbar-form navbar-left">
      <div class="form-group">
        <input id="username" name="username" type="text" class="form-control" placeholder="Usuario">
      </div>
      <div class="form-group">
        <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña">
      </div>
      <button type="submit" class="btn btn-warning">Iniciar sesión</button>
    </form>
    '; 
  }else{
   echo '
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Bienvenid@ <b>'.strtoupper($Qry_identificarEx->fields['nombre']).' </b><b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
         
          <li><a href="../sitio/logout.php"><span class="glyphicon glyphicon-lock"></span> Cerrar sesión</a></li>
        </ul>
      </li>
   ';
   }
 ?>


    </ul>


  </div>
</nav>