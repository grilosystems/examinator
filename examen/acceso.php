<?php
	
	include("../conexion.php");
	
	session_name('user_examinado');
	session_start();
		
	$_SESSION['idClave'] = '';
	$_SESSION['idExaminado'] = '';
	$_SESSION['nomExaminado'] = '';
	$_SESSION['sexExaminado'] = '';
	$_SESSION['exaExaminado'] = '';
	$_SESSION['nomExamen'] = '';
	$_SESSION['numSeccion'] = '';
	$_SESSION['tiempoExamen'] = '';
	
	$claveCandidato = $_POST['clave_candidato'];
	
	if($claveCandidato!=""){
		conectar("on");
			mysql_query("SET NAMES 'utf8'");
			$consulta = "SELECT id_examinado,
						realizado AS hecho,
						nombre_examinado AS nombre,
						clave_candidato AS idexaminado, 
						sexo AS sexo,
						id_examen AS examen,
						(SELECT nombre_examen FROM examen WHERE id_examen=examinado.id_examen) AS nombreDeExamen,
						(SELECT COUNT(*) FROM seccion WHERE id_examen=examen) AS numDeSecciones,
						(SELECT SUM(tiempo_seccion) FROM seccion WHERE id_examen=examen) AS tiempoDeExamen
						FROM examinado WHERE clave_candidato='".$claveCandidato."'";
			
			$resultado = mysql_query($consulta);
			
			if(!mysql_num_rows($resultado)){
				echo '
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<script type="text/javascript">
					alert("No existe el candidato: '.$claveCandidato.'");
					window.location.assign("index.html");
				</script>';
			}
			
			while($fila=mysql_fetch_array($resultado)){
				if($fila['hecho']==0){
					$_SESSION['idClave'] = $fila['idexaminado'];
					$_SESSION['idExaminado'] = $fila['id_examinado'];
					$_SESSION['nomExaminado'] = $fila['nombre'];
					$_SESSION['sexExaminado'] = $fila['sexo'];
					$_SESSION['exaExaminado'] = $fila['examen'];
					$_SESSION['nomExamen'] = $fila['nombreDeExamen'];
					$_SESSION['numSeccion'] = $fila['numDeSecciones'];
					$_SESSION['tiempoExamen'] = $fila['tiempoDeExamen'];
				}else{
					echo '
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<script type="text/javascript">
					alert("El candidato: '.$claveCandidato.' ya realizo el examen.");
					window.location.assign("index.html");
				</script>';
				}
			}
			
		conectar("off");
		header("Location: startExamen.php");
	}
	//echo $_SESSION['idClave'];

?>