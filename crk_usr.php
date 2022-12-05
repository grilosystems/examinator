<?php
	//Evita que se entre directamente a la pagina
	session_name('user_sesion');
	session_start();
	if(isset($_SESSION['usr_ses']) && isset($_SESSION['id_usr'])){
		$usuario = $_SESSION['usr_ses'];
		$id_admin = $_SESSION['id_usr'];
		if($usuario=="nada" || $id_admin=="nada"){
			header('Location: index.html');
		}
	}else{
		header('Location: http://www.grilosystems.com');
	}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Registrar nuevo usuario</title>
<link href="css/jqueryui.min.css" rel="stylesheet" type="text/css">
<script language="javascript" src="js/jquery-2.0.0.min.js"></script>
<script language="javascript" src="js/jqueryui.js"></script>
<script language="javascript" src="js/funcs.js"></script>
<script language="javascript">
	$(document).ready(function(e) {
        $("#cancelar").button();
		$("#guardar").button();
    });
</script>
</head>

<body style="font-size:12px;background: url(img/bgnoise_lg.png) repeat left top;">
<div style="margin:auto; margin-top:150px; border:2px dashed #000; width:500px; height:220px;">
	<p><h1>&nbsp;&nbsp;&nbsp;Crear nuevo usuario</h1></p>
    <form action="admin.php" method="post" onSubmit="return verifica();">
    <table style="font-size:17px;" align="center">
    	<tr>
        	<td align="right" valign="middle">Correo: </td>
            <td><input type="text" id="correo" name="correo" maxlength="50" /></td>
        </tr>
        <tr>
        	<td align="right" valign="middle">Password: </td>
            <td><input type="text" id="psw" name="psw" maxlength="10" /></td>
        </tr>
        <tr>
        	<td align="right" valign="middle">Nombre: </td>
            <td><input type="text" id="nombre" name="nombre" maxlength="199" /></td>
        </tr>
        <tr>
        	<td align="right" valign="middle">Tel&eacute;fono: </td>
            <td><input type="text" id="tel" name="tel" maxlength="50" /></td>
        </tr>
    </table>
    <table align="center">
    	<tr>
        	<td><input id="cancelar" type="button" onClick="cancelarCrk();" value="Cancelar" /></td>
            <td><input id="guardar" type="submit" value="Guardar" /></td>
        </tr>
    </table>
    <input type="hidden" name="accion" value="agrcrk" />
    </form>
    <div id="avisos"></div>
</div>
</body>
</html>
