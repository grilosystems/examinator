<?php
	
	/* Conexión a la base de datos */
	
	function conectar($onoff){
		//Conexion a la base de datos

		/*PARAMETROS SERVIDOR LOCAL*/
		$servidor="localhost";
		$usuario="root"; 
		$clave="admin";
		$base="examinator";
		$conexion = mysql_connect($servidor,$usuario,$clave);
		if($onoff=="on"){
			//Abriendo conexion
			if(!$conexion){
				die("<style type='text/css' media='all'>
						a { text-decoration:none; color:#06C; }
						a:hover { text-decoration:underline; }
						a:visited { color:#06C; }
						p { font-family:'Arial'; font-size:18px; color:#06C; }
			  		</style>
			  		<p align='center'>No se ha podido conectar con la base de datos por causa de un error.</p>
			  		<br /><a href='http://www.grilosystems.com'><p align='center'>Aceptar</p></a>");
			}
			mysql_select_db($base,$conexion); 
		}else if($onoff=="off"){
			mysql_close($conexion);
		}else{ echo 'Error: No especifico parametro valido'; }
	}
	
?>