<?php
	
	include("conexion.php");
	
	 session_name('user_sesion');
	 session_start();
	 $_SESSION['usr_ses']='nada';
	 $_SESSION['id_usr']='';
	 $_SESSION['correo_usr']='nada';
	
	 $clave = strip_tags($_POST['clave_usr']);
	 $usr = strip_tags($_POST['mail_usr']);
	 $crear_usr = $_POST['crk_usr'];
	 
	 if($usr!=""){
	 conectar("on");
	 mysql_query("SET NAMES 'utf8'");
	 $consulta = mysql_query('SELECT * FROM usuarios WHERE correo_usuario="'.$usr.'"');
	 if(!mysql_num_rows($consulta)){
		 echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		 <script type="text/javascript">
			alert("No existe el usuario: '.$usr.'");
			window.location.assign("index.html");
	     </script>';
		 //echo 'No Existe el Usuario: '.$usr.'.'; 
	 }

	 while($fila=mysql_fetch_array($consulta)){
		 if($clave == $fila['password_usuario']){
			//Redireccionar a la pagina menu
			$_SESSION['usr_ses']=$fila['nombre_usuario'];
			$_SESSION['id_usr']=$fila['id_usuario'];
			$_SESSION['correo_usr']=$fila['email_usuario'];
			if($crear_usr == "1"){
				header('Location: crk_usr.php');
			}else{
				header('Location: panel.php');
			}
			break;
		 }else{
			 echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			 	<script type="text/javascript">
			 		alert("El usuario parece existir, pero la contraseña no es correcta.");
					window.location.assign("index.html");
				</script>';
			 break;
		 }
	 }
	 conectar("off");
	 }else{
		 echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		 <script type="text/javascript">
		 	alert("No introdujo nombre de usuario, verifique.");
			window.location.assign("index.html");
		 </script>';
	 }
?>