<?php
	session_name('user_examinado');
	session_start();
	
	$examinado = $_SESSION['idExaminado'];
	$estExamen = $_SESSION['exaExaminado'];
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />
<title>Examen</title>
<link rel="stylesheet" type="text/css" href="../css/prexam.css" />
<script src="../js/jquery-2.0.0.min.js" type="text/javascript"></script>
<script src="../js/funcs.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.timer.js"></script>
<script src="js/funExa.js" type="text/javascript"></script>
<script>
	$(document).ready(function(e) {
		var np = $("#np").val();
		cargarPregunta("next","&np="+np); 
		cargarPregunta("obtenTmp","");
		cargarPregunta("obtenSec","");
		$("#siguiente").click(function(){
			nextPregunta();
		});
    });
	document.oncontextmenu = function(){return false}
</script>
</head>

<body onload="changeHashOnLoad();" style="background: url(../img/bgnoise_lg.png) repeat left top;">
<div id="contenedor">
	<div id="tmpc">
    		<p>Tiempo de la secci&oacute;n: <span id="countdown">05:00:00</span> minutos.</p>
    <form id="tmpSec">
        <input id="obTm" type='hidden' value='5' style='width:30px;' />
    </form>
    </div>
 	<form action="enviaResp.php" id="envResp" method="post">
        <div id="pregunta"></div>
        <input type="hidden" id="idseccion" name="seccion" value="" />
        <input type="hidden" name="examen" value="<?=$estExamen?>" />
        <input type="hidden" name="examinado" value="<?=$examinado?>" />
        <input type="hidden" id="tiempoFinal" name="tiempoFinal" />
        <input type="hidden" id="respcorrectas" name="respcorrectas" value="0" />
        <br />
        <center><input type="hidden" id="fin" onClick="pararTm();" value="Finalizar" /></center>
    </form>
    <div id="controles">
    	<input type="hidden" id="respcor" />
        <input type="hidden" id="np" value="1" />
        <br />
        <button id="siguiente">Siguiente</button>
    </div>
</div>
</body>
</html>
