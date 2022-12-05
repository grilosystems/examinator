<?php
	
	session_name('user_examinado');
	session_start();
	$_SESSION['ptroSeccion'] = "1";
	$saludo = "";
	if($_SESSION['sexExaminado']==""){
		header("Location: index.html");
	}
	if($_SESSION['sexExaminado']=="M"){
		$saludo = "Bienvenido ";
	}else{
		$saludo = "Bienvenida ";
	}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Iniciar</title>
<script src="js/funExa.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/prexam.css" />
</head>

<body style="background: url(../img/bgnoise_lg.png) repeat left top;">
<div id="contenedorIni">
	<header>
    	<div id="titulo">
    	<h1>Instrucciones del examen</h1>
        </div>
        <div id="nombre">
        <h2>
        	<?=$saludo?><?=$_SESSION['nomExaminado']?>
        </h2>
        <h2>
        	Tu ID de candidato es: <?=$_SESSION['idClave']?>
        </h2>
        </div>
    </header>
    <section>
    <div id="informacion">
    	<h3>
        	El examen <span class="resalta">"<?=$_SESSION['nomExamen']?>"</span>, tiene una duración de <span class="resalta"><?=$_SESSION['tiempoExamen']?></span> minutos, dividido en <span class="resalta"><?=$_SESSION['numSeccion']?></span> secciones, que se cambiaran conforme realice las secciones anteriores, en cada una de ellas se mostrara el tiempo que dura y el nombre de la sección.
        </h3>
        <h3>
        	<span class="resalta">RECOMENDACIONES:</span> De preferencia verifique que su computadora este conectada por cable Ethernet a su modem, si usa laptop que esta conectada a un cargador o que tenga suficiente carga en la batería para el tiempo que dura el examen, una vez iniciado no podrá cancelar el examen, de lo contrario se verificara mal dando malos resultados en su prueba.
        </h3>
        <h3>
        	<span class="resalta">NOTA:</span> Verifique antes de empezar que se indique que hay mínimo 1 sección, de lo contrario avise por el medio que se le indico sobre esta situación y no inicie el examen.
        </h3>
    </div>
    </section>
    <footer>
    	<input type="button" id="cancelar" onClick="irA('cerrarSesion.php');" value="Cancelar" />
        <input type="button" id="iniciar" onClick="irA('exam.php');" value="Iniciar" />
    </footer>
</div>
</body>
</html>
