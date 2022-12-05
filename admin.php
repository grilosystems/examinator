<?php
	
	$accion = $_POST['accion'];
	
	include("conexion.php");
	include("ccandidato.php");
	require('html2pdf.php');
	
	switch($accion){
		case 'agrcrk':
			//Agregar nuevo usuario
			$correo_usuario = $_POST['correo'];
			$psw_usuario = $_POST['psw'];
			$nom_usuario = $_POST['nombre'];
			$tel_usuario = $_POST['tel'];
			
			if($tel_usuario == ""){
				$tel_usuario = "Ninguno";
			}
			$consulta = "INSERT INTO `usuarios` (`correo_usuario`, `password_usuario`, `nombre_usuario`, `telefono_usuario`) 
						 VALUES ('".$correo_usuario."', '".$psw_usuario."', '".$nom_usuario."', '".$tel_usuario."')";
			agregar($consulta);
			echo '<script language="javascript">
				alert("Se ha creado el usuario: '.$correo_usuario.' correctamente.");
				window.location.assign("panel.php");
			</script>';
		break;
		case 'agrCand':
			$id_examen = $_POST['examen'];
			$id_usr_registro = $_POST['idUsr'];
			$fecha_registro = date("y").date("n").date("j");
			$clave_candidato = "0";
			$archivo_cv = $_FILES['cv']['tmp_name'];
			$nombre_examinado = $_POST['nombre'];
			$edad_examinado = $_POST['edad'];
			$domicilio_examinado = $_POST['dom'];
			$curp_examinado = $_POST['curp'];
			$sexo = $_POST['sexo'];
			$email_examinado = $_POST['mail'];
			$telefono_examinado = $_POST['tel'];
			$cel = $_POST['cel'];
			
			if($id_usr_registro!=""){
				$consulta = "INSERT INTO examinado (id_examen, id_usr_registro, fecha_registro, clave_candidato, archivo_cv, nombre_examinado, edad_examinado, domicilio_examinado, curp_examinado, sexo, email_examinado, telefono_examinado, celular_examinado) 
			VALUES ('".$id_examen."', '".$id_usr_registro."', '".$fecha_registro."', '".$clave_candidato."', '".$archivo_cv."', '".$nombre_examinado."', '".$edad_examinado."', '".$domicilio_examinado."', '".$curp_examinado."', '".$sexo."', '".$email_examinado."', '".$telefono_examinado."', '".$cel."')";
				agregar($consulta);
				$id_actual = recuperaID("id_examinado","examinado");
				$DMA = date("j").date("n").date("y");
				$HM = date("G").date("i");
				$clave_candidato = "OTA".$id_usr_registro.$DMA.$HM.$id_actual;
				
				if($archivo_cv!=""){
					$nombre_arch_cv = subirArchivo($archivo_cv,$clave_candidato);
					$consulta = "UPDATE `examinado` SET `clave_candidato`='".$clave_candidato."', archivo_cv='".$nombre_arch_cv."' WHERE `id_examinado`='".$id_actual."'";
					agregar($consulta);
				}else{
					$consulta = "UPDATE `examinado` SET `clave_candidato`='".$clave_candidato."' WHERE `id_examinado`='".$id_actual."'";
					agregar($consulta);
				}
				echo '
				<script language="javascript">
					alert("Se ha creado el candidato: '.$clave_candidato.' correctamente.");
					window.location.assign("panel.php");
				</script>';
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}
		break;
		case 'agrExam':
			$id_usr = $_POST['idUsr'];
			$nom_exam = $_POST['nombreExamen'];
			$desc_exam = $_POST['description'];
			
			if($id_usr!=""){
				$consulta = "INSERT INTO `examen` (`nombre_examen`, `descripcion_examen`) 
							VALUES ('".$nom_exam."', '".$desc_exam."')";
				agregar($consulta);
				echo '
				<script language="javascript">
					alert("Se ha creado el examen: '.$nom_exam.' correctamente.");
					window.location.assign("panel.php");
				</script>';
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}
		break;
		case 'ediExam':
			$id_usr = $_POST['idUsr'];
			$nom_exam = $_POST['nombreExamen'];
			$desc_exam = $_POST['description'];
			$id_examen = $_POST['examen'];
			
			if($id_usr!=""){
				$consulta = "UPDATE examen SET descripcion_examen='".$desc_exam."', nombre_examen='".$nom_exam."' WHERE id_examen='".$id_examen."'";
				agregar($consulta);
				echo '
				<script language="javascript">
					alert("Se actualizo el examen: '.$nom_exam.' correctamente.");
					window.location.assign("panel.php");
				</script>';
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}
		break;
		case 'delExam':
			$id_usr = $_POST['idUsr'];
			$examenDel = $_POST['examen'];
			$nomExamen;
			$idSeccion;
			
			if($id_usr!=""){
				$idSeccion = obtener("seccion","id_examen",$examenDel,"id_seccion");
				$nomExamen = obtener("examen","id_examen",$examenDel,"nombre_examen");
				
				$consultaDel = "DELETE FROM `pregunta` WHERE `id_seccion`='".$idSeccion."';";
				agregar($consultaDel);
				$consultaDel = "DELETE FROM `seccion` WHERE `id_examen`='".$examenDel."';";
				agregar($consultaDel);
				$consultaDel = "DELETE FROM `examen` WHERE `id_examen`='".$examenDel."';";
				agregar($consultaDel);
				$idSeccion = obtener("seccion","id_examen",$examenDel,"id_seccion");
				echo '
				<script language="javascript">
					alert("Se elimino el examen: '.$nomExamen.' correctamente.");
					window.location.assign("panel.php");
				</script>';
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}
		break;
		case 'buscarExamen':
			$id_examen = $_POST['id'];
			$nombre = "";
			$desc = "";
			conectar("on");
				mysql_query("SET NAMES 'utf8'");
				$consulta = "SELECT nombre_examen AS nombre, descripcion_examen AS descripcion FROM examen WHERE id_examen='".$id_examen."'";
				$resultado = mysql_query($consulta);
				if(!mysql_num_rows($resultado)){
					echo '0';
				}else{
					 while($fila=mysql_fetch_array($resultado)){
						 $nombre = $fila['nombre'];
						 $desc = $fila['descripcion'];
					 }
				}
			conectar("off");
			echo $nombre."-".$desc;
		break;
		case 'agrSec':
			$id_usr = $_POST['idUsr'];
			$id_examen = $_POST['examenS'];
			$nom_seccion = $_POST['nombreSeccion'];
			$tiempo_seccion = $_POST['tiempoSeccion'];
			
			if($id_usr!=""){
				$consulta = "INSERT INTO `seccion` (id_examen, nombre_seccion, tiempo_seccion) 
							VALUES ('".$id_examen."', '".$nom_seccion."', '".$tiempo_seccion."')";
				agregar($consulta);
				echo '
				<script language="javascript">
					alert("Se ha creado la secci&oacute;n: '.$nom_exam.' correctamente.");
					window.location.assign("panel.php");
				</script>';
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}			
		break;
		case 'ediSec':
			$id_usr = $_POST['idUsr'];
			$id_seccion = $_POST['idSeccionS'];
			$id_examen = $_POST['examenS'];
			$nom_seccion = $_POST['nombreSE'];
			$tiempo_seccion = $_POST['tiempoSeccion'];
			
			if($id_usr!=""){
				$consulta = "UPDATE seccion SET id_examen='".$id_examen."', nombre_seccion='".$nom_seccion."', tiempo_seccion='".$tiempo_seccion."' WHERE id_seccion='".$id_seccion."'";
				agregar($consulta);
				echo '
				<script language="javascript">
					alert("Se actualizo la sección: '.$nom_seccion.' correctamente.");
					window.location.assign("panel.php");
				</script>';
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}
		break;
		case 'delSecc':
			$id_usr = $_POST['idUsr'];
			$seccionDel = $_POST['idSeccionS'];
			
			if($id_usr!=""){
				$nomSeccion = obtener("seccion","id_seccion",$seccionDel,"nombre_seccion");
				
				$consultaDel = "DELETE FROM `pregunta` WHERE `id_seccion`='".$seccionDel."';";
				agregar($consultaDel);
				$consultaDel = "DELETE FROM `seccion` WHERE `id_seccion`='".$seccionDel."';";
				agregar($consultaDel);
				
				echo '
				<meta charset="UTF-8">
				<script language="javascript">
					alert("Se elimino la sección: '.$nomSeccion.' correctamente.");
					window.location.assign("panel.php");
				</script>';
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}
		break;
		case 'buscarSeccion':
			$id_seccion = $_POST['id'];
			$examen = "";
			$nombre = "";
			$tiempo = "";
			conectar("on");
				mysql_query("SET NAMES 'utf8'");
				$consulta = "SELECT id_examen AS examen, nombre_seccion AS nombre, tiempo_seccion AS tiempo FROM seccion WHERE id_seccion='".$id_seccion."'";
				$resultado = mysql_query($consulta);
				if(!mysql_num_rows($resultado)){
					echo '0';
				}else{
					 while($fila=mysql_fetch_array($resultado)){
						 $examen = $fila['examen'];
						 $nombre = $fila['nombre'];
						 $tiempo = $fila['tiempo'];
					 }
				}
			conectar("off");
			echo $examen."-".$nombre."-".$tiempo;
		break;
		case 'agrPre':
			$id_usr = $_POST['idUsr'];
			$id_seccion = $_POST['idSeccionP'];
			$pregunta = $_POST['pregunta'];
			$resp1 = $_POST['nr1'];
			$resp2 = $_POST['nr2'];
			$resp3 = $_POST['nr3'];
			$resp4 = $_POST['nr4'];
			$respcor = $_POST['respcor'];
			
			if($id_usr!=""){
				$consulta = "INSERT INTO `pregunta` (`id_seccion`, `pregunta`, `resp1`, `resp2`, `resp3`, `resp4`, `respcor`) 
							VALUES ('".$id_seccion."', '".$pregunta."', '".$resp1."', '".$resp2."', '".$resp3."', '".$resp4."', '".$respcor."')";
				agregar($consulta);
				echo '
				<script language="javascript">
					alert("Se ha creado la pregunta: '.$pregunta.' correctamente.");
					window.location.assign("panel.php");
				</script>';
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}	
		break;
		case 'cargarPreguntas':
			$id_secc_pregunta = $_POST['id'];
			conectar("on");
				mysql_query("SET NAMES 'utf8'");
				$preguntas = mysql_query('SELECT id_pregunta, pregunta FROM pregunta WHERE id_seccion='.$id_secc_pregunta);
				if(mysql_num_rows($preguntas) != 0){
					while($fila=mysql_fetch_array($preguntas)){
						echo '<option value="'.$fila['id_pregunta'].'">'.$fila['pregunta'].'</option>'; 
					}
				}else{
					echo '<option value="">No hay preguntas</option>';
				}
			conectar("off");
		break;
		case 'delPre':
			$id_usr = $_POST['idUsr'];
			$preguntaDel = $_POST['idDelPre'];
			
			if($id_usr!=""){
				$nomPregunta = obtener("pregunta","id_pregunta",$preguntaDel,"pregunta");
				
				$consultaDel = "DELETE FROM `pregunta` WHERE `id_pregunta`='".$preguntaDel."';";
				agregar($consultaDel);
				
				echo '
				<meta charset="UTF-8">
				<script language="javascript">
					alert("Se elimino la pregunta: '.$nomPregunta.' correctamente.");
					window.location.assign("panel.php");
				</script>';
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}
		break;
		case 'buscarPregunta':
			$id_pregunta = $_POST['id'];
			$pregunta = "";
			$r1 = "";
			$r2 = "";
			$r3 = "";
			$r4 = "";
			$correctas = "";
			conectar("on");
				mysql_query("SET NAMES 'utf8'");
				$consulta = "select pregunta AS pregunta, resp1 AS r1, resp2 AS r2, resp3 AS r3, resp4 AS r4, respcor AS correcta from pregunta WHERE id_pregunta=".$id_pregunta;
				$resultado = mysql_query($consulta);
				if(!mysql_num_rows($resultado)){
					echo '0';
				}else{
					 while($fila=mysql_fetch_array($resultado)){
						 $pregunta = $fila['pregunta'];
						 $r1 = $fila['r1'];
						 $r2 = $fila['r2'];
						 $r3 = $fila['r3'];
						 $r4 = $fila['r4'];
						 $correctas = $fila['correcta'];
					 }
				}
			conectar("off");
			echo $pregunta."-".$r1."-".$r2."-".$r3."-".$r4."-".$correctas;
		break;
		case 'ediPre':
			$id_usr = $_POST['idUsr'];
			$id_seccionEP = $_POST['idSeccionEP'];
			$id_preguntaEP = $_POST['idpregunta'];
			$pregunta = $_POST['pregunta'];
			$resp1 = $_POST['nr1'];
			$resp2 = $_POST['nr2'];
			$resp3 = $_POST['nr3'];
			$resp4 = $_POST['nr4'];
			$respcor = $_POST['respcor'];
			
			if($id_usr!=""){
				$consulta = "UPDATE `pregunta` SET pregunta='".$pregunta."', resp1='".$resp1."', resp2='".$resp2."', resp3='".$resp3."', resp4='".$resp4."', respcor='".$respcor."', id_seccion='".$id_seccionEP."' WHERE id_pregunta='".$id_preguntaEP."'";
				agregar($consulta);
				echo '
				<script language="javascript">
					alert("Se ha actualizado la pregunta: '.$pregunta.' correctamente.");
					window.location.assign("panel.php");
				</script>';
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}
		break;
		case 'buscarCand':
			$clvCandidato = $_POST['id'];
			session_name('user_sesion');
			session_start();
			if(isset($_SESSION['usr_ses']) && isset($_SESSION['id_usr'])){
				$candidato = new Candidato($clvCandidato);
				echo $candidato->getCandidato()."_".
					 $candidato->getResultados($candidato->getIDCandidato(),$candidato->getNombre())."_".
					 $candidato->getCurriculum();
			}else{
				echo msjError("Al parecer no esta dentro de un usuario registrado.","index.html");
			}
		break;
		case 'deleteCandidato':
			session_name('user_sesion');
			session_start();
			if(isset($_SESSION['usr_ses']) && isset($_SESSION['id_usr'])){
				$candidatoDel = "UPDATE `examinado` SET `status_examinado`='0' WHERE clave_candidato='".$_POST['id']."'";
				agregar($candidatoDel);
				echo "El candidato ".$_POST['id']." se elimino.";
			}else{
				echo "Error";
			}
		break;
		case 'crearReporte':
			$datosGenerales = $_POST['datosGenerales'];
			$resultadosCandidato = $_POST['resultados'];
			$text = '<img src="img/logo.jpg" width="100" height="70"><br><br>                                                               <b>REPORTE DE RESULTADOS</b>
			<br><br>
			<b>_________________________________________________________________________</b>
			<br><br>
			<b><font color="#0000" face="sans-serif">
			DATOS GENERALES
			</font></b>
			<br><br>
			'.$datosGenerales.'
			<br><br>
			<b><font color="#0000" face="sans-serif">
			RESULTADOS
			</font></b><br><br>'
			.$resultadosCandidato;
			
			$pdf=new PDF_HTML();
			$pdf->SetFont('Arial','',12);
			$pdf->AddPage();
			if(ini_get('magic_quotes_gpc')=='1')
				$text=stripslashes($text);
			$pdf->WriteHTML($text);
			$pdf->Output();
			exit;
		break;
	}//Fin de switch
	
	function agregar($consulta){
		conectar("on");
			mysql_query("SET NAMES 'utf8'");
			mysql_query($consulta);
		conectar("off");
	}
	
	function recuperaID($campo,$tabla){
		conectar("on");
			$consulta = "SELECT MAX(".$campo.") as ultimo_ID FROM ".$tabla."";
			$los_ids = mysql_query($consulta);
			while($fila=mysql_fetch_array($los_ids)){
				$el_id=$fila['ultimo_ID'];
			}
		conectar("off");
		return $el_id;
	}
	
	function subirArchivo($nombreArchivo, $clvCand){
		if($nombreArchivo!=""){
			$origenArchivo=$nombreArchivo;
			$destinoArchivo="cvs/"."CV".$clvCand.".pdf";
			move_uploaded_file($origenArchivo,$destinoArchivo);
			return $destinoArchivo;
		}else{
			return "Falto un parametro.";
		}
	}
	
	function obtener( $tabla, $iden, $id, $campo ){  
		global $config, $sql_link;  
		if( $id == "" ){  
			return "Error: Falta id del examen.";  
		}
		conectar("on");	  
			// obtener datos del usuario  
			$q = "SELECT * FROM `$tabla` WHERE `$iden` = '$id'";  
			$result = mysql_query($q);  
			$ret = mysql_fetch_array($result);  
			$segm = $ret[$campo];  
			mysql_free_result($result); 
		conectar("off"); 
		return $segm;  
	}
	
	function msjError($mensaje,$vinculo){
		return '<!doctype html><html><head><meta charset="UTF-8"><title>ERROR</title><style>
						div{
							width:500px; 
							height:150px; 
							border:double 1px #000000;
							margin:auto;
							margin-top:200px;
						}
						a{
							color:#000;
							text-decoration:none;
							font-weight:bold;
						}
						a:hover{
							font-weight:bold;
							color:#F00;
							text-decoration:underline;
						}
						a:visited{
							color:#000;
							text-decoration:none;
							font-weight:bold;
						}
						</style></head><body><div>
							<p><h1>&nbsp;Error:</h1></p>
							<p align="center"><h3>&nbsp;&nbsp;'.$mensaje.'</h3></p>
							<p align="center"><a href="'.$vinculo.'">Aceptar</a></p>
						</div></body></html>';
	}
?>