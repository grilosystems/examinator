<?php
	
	include("../conexion.php");
	session_name('user_examinado');
	session_start();
	
	$numeroSecciones = $_SESSION['numSeccion'];
	$id_examen = $_SESSION['exaExaminado'];
	$ptroSeccion = $_SESSION['ptroSeccion'];
	
	$secciones[$numeroSecciones]['id']['nombre']['nPreguntas']['tiempo'];
	$indice = 1;
	
	conectar("on");
		mysql_query("SET NAMES 'utf8'");
		$consulta = "SELECT id_seccion, nombre_seccion, tiempo_seccion,
					(SELECT COUNT(*) FROM pregunta WHERE id_seccion = seccion.id_seccion) AS numPreguntas 
					FROM seccion WHERE id_examen='".$id_examen."'";
					
		$matrizSecciones = mysql_query($consulta);
		
		while($fila=mysql_fetch_array($matrizSecciones)){
			$secciones[$indice]['id']=$fila['id_seccion'];
			$secciones[$indice]['nombre']=$fila['nombre_seccion'];
			$secciones[$indice]['nPreguntas']=$fila['numPreguntas'];
			$secciones[$indice]['tiempo']=$fila['tiempo_seccion'];
			$indice++;
		}
		
		$indice = 3; //Este parametro apunta a la seccion
		$indice2 = 1;
		
		$npreg = $secciones[$indice]['nPreguntas'];
		$preguntas[$npreg]['pregunta']['r1']['r2']['r3']['r4']['rc'];
		
		$consulta = "SELECT pregunta, resp1, resp2, resp3, resp4, respcor FROM pregunta WHERE id_seccion='".$secciones[$ptroSeccion]['id']."'";
		$resultadosP = mysql_query($consulta);
		while($fila=mysql_fetch_array($resultadosP)){
			$preguntas[$indice2]['pregunta']=$fila['pregunta'];
			$preguntas[$indice2]['r1']=$fila['resp1'];
			$preguntas[$indice2]['r2']=$fila['resp2'];
			$preguntas[$indice2]['r3']=$fila['resp3'];
			$preguntas[$indice2]['r4']=$fila['resp4'];
			$preguntas[$indice2]['rc']=$fila['respcor'];
			$indice2++;
		}
	conectar("off");
	
	/*for($i=1;$i<=$numeroSecciones;$i++){
		echo $secciones[$i]['id']." ".$secciones[$i]['nombre']." ".$secciones[$i]['nPreguntas']." ".$secciones[$i]['tiempo']."<br />";
	}
	echo "<meta charset='UTF-8'>";
	for($i=1;$i<=$npreg;$i++){
		echo $preguntas[$i]['pregunta']."<br />";
	}*/

	$numpreg = $_POST['np'];
	$respuesta = $_POST['resp'];
	$control = $_POST['control'];
	switch($control){
		case 'next':
			if($preguntas[$numpreg]['pregunta']!=""){
				echo '
					<h3 class="pregunta">'.$preguntas[$numpreg]['pregunta'].'</h3>
					<label><input type="radio" id="r1" value="R1" name="opResp">'.$preguntas[$numpreg]['r1'].'</label>
					<label><input type="radio" id="r2" value="R2" name="opResp">'.$preguntas[$numpreg]['r2'].'</label>
					<label><input type="radio" id="r3" value="R3" name="opResp">'.$preguntas[$numpreg]['r3'].'</label>
					<label><input type="radio" id="r4" value="R4" name="opResp">'.$preguntas[$numpreg]['r4'].'</label>
				';
			}else{
				echo "fin";
			}
		break;
		case 'revisa':
			if($respuesta==$preguntas[$numpreg]['rc']){
				echo "1";
			}else{
				echo "0";
			}
		break;
		case 'obtenTmp':
			$tiempoSeccion = $secciones[$ptroSeccion]['tiempo'];
			echo $tiempoSeccion;
		break;
		case 'obtenSec':
			$idSeccion = $secciones[$ptroSeccion]['id'];
			echo $idSeccion;
		break;
	}
?>