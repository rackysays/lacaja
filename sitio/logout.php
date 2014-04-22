<!--
  Desarrollado por: Ing. Ernesto Enrique FLames
  Fecha: 10/10/2013
  MODULO: script desloguerse
-->
<?php
require_once('../includes/UserAuthentication.class.php');  
$userAuthentication = new UserAuthentication();
$userAuthentication->doLogout();
header ("Location: index.php");
?>