<?php
	
	include("../conexion.php");
	
	session_name('user_examinado');
	session_start();
	
	$totalSeccs = $_SESSION['numSeccion'];
	$ptroSeccion = $_SESSION['ptroSeccion'];
	
	$idExamen = $_POST['examen'];
	$idSeccion = $_POST['seccion'];
	$idExaminado = $_POST['examinado'];
	$respuestas = $_POST['respcorrectas'];
	$tiempo = $_POST['tiempoFinal'];
	
	if($_SESSION['idExaminado']!=""){
		$consulta = "INSERT INTO `respexam` (`id_examen`, `id_seccion`, `id_examinado`, `respcorrectas`, `tiempo_final`) 
					VALUES ('".$idExamen."', '".$idSeccion."', '".$idExaminado."', '".$respuestas."', '".$tiempo."')";
		agregar($consulta);
		if($ptroSeccion<$totalSeccs){
			$ptroSeccion++;
			$_SESSION['ptroSeccion'] = $ptroSeccion;
			echo '<!doctype html>
				<html>
				<head>
				<meta charset="UTF-8">
				<title>Iniciar</title>
				<script src="js/funExa.js" type="text/javascript"></script>
				<link rel="stylesheet" type="text/css" href="../css/prexam.css" />
				</head>
				
				<body onload=\'changeHashOnLoad();\' style="background: url(../img/bgnoise_lg.png) repeat left top;">
				<div id="contenedorIni">
					<header>
						<div id="nombre">
						<h1>
							Muy bien <span class="resalta">'.$_SESSION['nomExaminado'].'</span>
						</h1>
						</div>
					</header>
					<section>
					<div id="informacion">
						<h2>
							Ahora, pasaras a la siguiente secci&oacute;n.
						</h2>
					</div>
					</section>
					<footer>
						<input type="button" id="iniciar" onClick="irA(\'exam.php\');" value="Iniciar siguente secci&oacute;n" />
					</footer>
				</div>
				</body>
				</html>';
		}else{
			$consulta = "UPDATE `examinado` SET `realizado`='1' WHERE `id_examinado`='".$idExaminado."'";
			agregar($consulta);
			echo '<!doctype html>
				<html>
				<head>
				<meta charset="UTF-8">
				<title>Iniciar</title>
				<script src="js/funExa.js" type="text/javascript"></script>
				<link rel="stylesheet" type="text/css" href="../css/prexam.css" />
				</head>
				
				<body onload=\'changeHashOnLoad();\' style="background: url(../img/bgnoise_lg.png) repeat left top;">
				<div id="contenedorIni">
					<header>
						<div id="nombre">
						<h1>
							Muy bien <span class="resalta">'.$_SESSION['nomExaminado'].'</span>
						</h1>
						</div>
					</header>
					<section>
					<div id="informacion">
						<h2>
							Termino el examen, espere que posteriormente su reclutador le de informaci&oacute;n sobre sus resultados.
						</h2>
					</div>
					</section>
					<footer>
						<input type="button" id="iniciar" onClick="irA(\'cerrarSesion.php\');" value="Finalizar" />
					</footer>
				</div>
				</body>
				</html>';
		}
		/*echo $idExamen."<br />";
		echo $idSeccion."<br />";
		echo $idExaminado."<br />";
		echo $respuestas."<br />";
		echo $tiempo."<br />";*/
	}else{
		echo msjError("Error: Al parecer se perdio la sessión.","index.html");
	}
	
	function agregar($consulta){
		conectar("on");
			mysql_query("SET NAMES 'utf8'");
			mysql_query($consulta);
		conectar("off");
	}
	
?>