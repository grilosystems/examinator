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
<title>Panel - Administraci&oacute;n</title>
<link href="css/stylemenu.css" type="text/css" rel="stylesheet">
<link href="css/html5-reset.css" type="text/css" rel="stylesheet">
<link href="css/jqueryui.min.css" rel="stylesheet" type="text/css">
<link href="css/jqicons.css" rel="stylesheet" type="text/css">
<script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>
<script src="js/modernizr-2.0.6.min.js" type="text/javascript"></script>
<script language="javascript" src="js/jqueryui.js"></script>
<script src="js/funcs.js" type="text/javascript"></script>
</head>

<body style="background: url(img/bgnoise_lg.png) repeat left top;">
<div id="container" style="width: 600px; margin:auto; border:0px solid #000;">

	<!-- begin navigation -->
	<nav id="navigation" style="margin-left:100px;">
		<ul>
			<li><a href="agregar.php" class="cargar">Ex&aacute;menes</a></li>
			<li><a href="realizados.php" class="cargar">Realizados</a></li>
            <li><a href="candidato.php" class="cargar">Candidato</a></li>
            <li><a href="empadd.php" class="cargar">Empresas</a></li>
			<li><a href="cerrarSesion.php">Cerrar</a></li>
		</ul>
	</nav>
	<!-- end navigation -->
	
</div>
<div id="contenido" style="margin:auto; border:0px solid #000; width:600px; height:400px;"></div>
</body>
</html>
