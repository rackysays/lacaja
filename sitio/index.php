<!DOCTYPE html>
<!-- LACAJITA.COM.VE
By Ernesto Flames and Ricardo Marquez -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../favicon.ico" />
<title>//- La Cajita de Aleida -// Principal</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<?php 
require_once('../includes/UserAuthentication.class.php');  
$userAuthentication = new UserAuthentication();
if(isset($_POST['username']) && $_POST['password']) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  // $uri = isset($_POST['uri']) && !empty($_POST['uri']) ? base64_decode($_POST['uri']) : '/';
  if($userAuthentication->doLogin($username,$password)) {
    header("Location: index.php");
  } else {
    $msg_error = '<center><b>ERROR:</b> Usuario o contraseña inv&aacute;lidos</center>';
  }
}

 if(isset($msg_error)) {
    echo '<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
        .$msg_error.'
      </div>
      ';
  }
 ?>
</head>

<body>
	<table width="940" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td><img src="../imagenes/logopeq.png" width="213" height="97" alt="Lacajita.com.ve" longdesc="http://www.lacajita.com.ve"></td>
		</tr>
		<tr>
			<td>
				<table width="100%" class="" border="0" cellpadding="0" cellspacing="0">
				  <tr>
				    <td><?php include('../includes/barrita.php'); ?></td>
				  </tr>
				  <tr>
				    <td bgcolor="#FFFFFF" height="762">&nbsp;</td>
				  </tr>
				  <tr>
				    <td bgcolor="#FFFFFF">&nbsp;</td>
				  </tr>
				  <tr>
				    <td bgcolor="#FFFFFF">&nbsp;</td>
				  </tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
