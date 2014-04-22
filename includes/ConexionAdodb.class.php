
<?php


  // Desarrollado por: Ing. Ernesto Enrique FLames
  // Fecha: 22-03-2014
  // MODULO: Conexion a BD por ADO Driver=Mysql
	
	$user="root";
	$password="password";
	$database="bdcajita";
	$server="mzsi082w7"; 
	$dbmysql=NewADOConnection("mysql");
	$dbmysql->PConnect($server,$user,$password,$database);
	//$dbmysql->debug=true;
?>