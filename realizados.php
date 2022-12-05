<?php
	//enviarDatos(',clave,',\"buscarCand\",\"frmRealizados\");
	include("conexion.php");
	session_name('user_sesion');
	session_start();
	if(isset($_SESSION['usr_ses']) && isset($_SESSION['id_usr'])){
	conectar("on");
		mysql_query("SET NAMES 'utf8'");
		$consulta = "SELECT clave_candidato AS clave,
						nombre_examinado AS nombre,
						email_examinado AS email,
						status_examinado AS status,
						(SELECT CASE realizado=0 WHEN TRUE THEN CONCAT('No realizado') ELSE
						CONCAT('<a href=\'javascript:enviarDatos(\"',clave,'\",\"buscarCand\",\"frmRealizados\");\'>REALIZADO</a>') END) AS estado,
						archivo_cv as cvpdf
					FROM examinado WHERE status_examinado=1";
		$resultado = mysql_query($consulta);
		
	conectar("off");
	}else{
		header('Location: index.html');
	}
?>
<head>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<link href="css/demo_table.css" type="text/css" rel="stylesheet">
<script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
<script language="javascript" src="js/jqueryui.js"></script>
<script language="javascript">
$(function (){
	$("#realizados").dataTable();
	$("#resultados").html("");
});
</script>
<style>
.clasedialog{
	font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; 
}
</style>
<meta charset="utf-8">
</head>
<body onLoad="pagina();">
<div style=" margin-top:10px; margin-left:50px; border:0px solid #000; width:500px; height:370px;">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="realizados" align="center">
    	<thead>
        	<tr>
            	<th>Clave</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        	<?php
				while($fila=mysql_fetch_array($resultado)){
					echo "<tr>
							<td>".$fila['clave']."</td>
							<td>".$fila['nombre']."</td>
							<td>".$fila['estado']."</td>
							<td><a href='javascript:examinadoDel(\"".$fila['clave']."\",\"deleteCandidato\");'>ELIMINAR</a></td>
						   </tr>";
				}
			?>
        </tbody>
    </table>
    <div id="resultados" title="Detalles"></div>
    <input type="hidden" id="respuesta" val="" />
</div>
</body>