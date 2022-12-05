<?php
	
	class Candidato{
		private $ID;
		private $nombre;
		private $sexo;
		private $edad;
		private $domicilio;
		private $curp;
		private $correo;
		private $telefono;
		private $mobil;
		private $curriculum;
		private $fechaRegistro;
		private $usuarioRegistro;
		
		function Candidato($claveCandidato){
			conectar("on");
				mysql_query("SET NAMES 'utf8'");
			
				$consulta = "SELECT 
							id_examinado AS ID,
							nombre_examinado AS nombre,
							sexo,
							edad_examinado AS edad,
							domicilio_examinado AS domicilio,
							curp_examinado AS curp,
							email_examinado AS correo,
							telefono_examinado AS telefono,
							celular_examinado AS mobil,
							archivo_cv AS curriculum,
							fecha_registro AS fechaReg,
							(SELECT nombre_usuario FROM usuarios WHERE id_usuario=id_usr_registro) AS usrRegistro 
							FROM examinado WHERE clave_candidato='".$claveCandidato."'";
				$resultado = mysql_query($consulta);
				while($fila=mysql_fetch_array($resultado)){
					$this->ID=$fila['ID'];
					$this->nombre=$fila['nombre'];
					$this->sexo=$fila['sexo'];
					$this->edad=$fila['edad'];
					$this->domicilio=$fila['domicilio'];
					$this->curp=$fila['curp'];
					$this->correo=$fila['correo'];
					$this->telefono=$fila['telefono'];
					$this->mobil=$fila['mobil'];
					$this->curriculum=$fila['curriculum'];
					$this->fechaRegistro=$fila['fechaReg'];
					$this->usuarioRegistro=$fila['usrRegistro'];
				}
			conectar("off");
		}
		function getIDCandidato(){
			return $this->ID;
		}
		function getCurriculum(){
			if($this->curriculum!=NULL){
				return $this->curriculum;
			}else{
				return "0";
			}
		}
		function getNombre(){
			return $this->nombre;
		}
		function getResultados($idExaminado,$nombreExaminado){
			$resultadoCandidato;
			conectar("on");
				mysql_query("SET NAMES 'utf8'");
				$examenes = mysql_query("SELECT 
										(SELECT nombre_examen FROM examen WHERE id_examen=respexam.id_examen) AS examen,
										(SELECT nombre_seccion FROM seccion WHERE id_seccion=respexam.id_seccion) AS seccion,
										respcorrectas,
										(SELECT COUNT(*) FROM pregunta WHERE id_seccion=respexam.id_seccion) AS numPreg,
										tiempo_final
										FROM respexam WHERE id_examinado='".$idExaminado."'");
			
				$resultadoCandidato = "Examinado:".$nombreExaminado."<br /><br />";
				
				while($fila=mysql_fetch_array($examenes)){
					$rcorrectas = (int) $fila['respcorrectas'];
					$npreg = (int) $fila['numPreg'];
					if($npreg == 0){
						$rcorrectas = "0";
						$npreg="0";
						$resultRespuestas = "Examen o sección eliminada";
					}else{
						$rcorrectas = $fila['respcorrectas'];
						$resultRespuestas ="Respuestras correctas: ".$rcorrectas." de ".$npreg;
					}
					$resultadoCandidato = $resultadoCandidato."Nombre de examen: ".$fila['examen']."<br />".
					"Seccion: ".$fila['seccion']."<br />".
					$resultRespuestas."<br/>".
					"Termino en: ".$fila['tiempo_final']."<br />"."<hr>";
				}
				conectar("off");
				return $resultadoCandidato;
		}
		function getCandidato(){
			$genero;
			if($this->sexo=="M"){
				$genero="Masculino";
			}else{
				$genero="Femenino";
			}
			$scandidato = 
				"Nombre: ".$this->nombre."<br />".
				"Sexo: ".$genero."<br />".
				"Edad: ".$this->edad." a&ntilde;os<br />".
				"Domicilio: ".$this->domicilio."<br />".
				"CURP: ".$this->curp."<br />".
				"E-Mail: ".$this->correo."<br />".
				"Tel&eacute;fono: ".$this->telefono."<br />".
				"Celular: ".$this->mobil."<br />".
				"Fecha de registro: ".$this->fechaRegistro."<br />".
				"Reclutador: ".$this->usuarioRegistro;
			return $scandidato;
		}
	}
	
/*	$clvCandidato = "OTA1311132471";
	$candidato = new Candidato($clvCandidato);
				echo $candidato->getCandidato()."<br />".$candidato->getCurriculum()."<br />".$candidato->getIDCandidato();*/
?>