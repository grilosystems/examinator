<?php
	include("conexion.php");
	session_name('user_sesion');
	session_start();
	$id_usr = $_SESSION['id_usr'];
?>
<head>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script language="javascript" src="js/funcs.js"></script>
<script language="javascript">
$(function (){
// Hover states on the static widgets
	$( "#icons li" ).hover(
		function() {
			$( this ).addClass( "ui-state-hover" );
		},
		function() {
			$( this ).removeClass( "ui-state-hover" );
		}
	);
	cargarDatos();
});
function cargarDatos(){ 
		var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, no se encontro!'},
      '.chosen-select-width'     : {width:"5%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }	
}
</script>
<link rel="stylesheet" href="css/chosen.css">
</head>
<body>
<div style=" margin-top:10px; margin-left:50px; border:0px solid #000; width:500px; height:370px;">
	<center><h2>Agregar un candidato</h2></center>
    <br />
	<form id="frmCandidato" method="post" action="admin.php" enctype="multipart/form-data" onSubmit="return verificaCandidato();">
	<table border="0" align="center">
    	<tr>
        	<td align="left" valign="middle">Aplicar examen:</td>
        	<td align="left" valign="middle">&nbsp;<select data-placeholder="Indique un examen..." id="seldesExamen" class="chosen-select" style="width:200px;" name="examen">
            	<option value=""></option>
            	<?php
					conectar("on");
					mysql_query("SET NAMES 'utf8'");
					$examenes = mysql_query('SELECT id_examen, nombre_examen FROM examen');
					if(mysql_num_rows($examenes) != 0){
						while($fila=mysql_fetch_array($examenes)){
							echo '<option value="'.$fila['id_examen'].'">'.$fila['nombre_examen'].'</option>'; 
						}
					}else{
						echo '<option value="">No hay ex&aacute;menes</option>';
					}
					conectar("off");
				?>
          	</select></td>
    	</tr>
    	<tr>
        	<td>Curr&iacute;culum (PDF):</td>
        	<td>&nbsp;<input type="file" name="cv" id="cv" style="width:200px;" /></td>
    	</tr>
    	<tr>
        	<td>Nombre completo:</td>
        	<td>&nbsp;<input type="text" name="nombre" id="nombre" maxlength="200" style="width:200px;" /></td>
    	</tr>
        <tr>
        	<td>Edad:</td>
        	<td>&nbsp;<input type="text" name="edad" id="edad" maxlength="2" onKeyPress="return soloNumeros(event);" style="width:200px;" /></td>
    	</tr>
        <tr>
        	<td>Domicilio:</td>
        	<td>&nbsp;<input type="text" name="dom" id="dom" maxlength="200" style="width:200px;" /></td>
    	</tr>
        <tr>
        	<td>CURP:</td>
        	<td>&nbsp;<input type="text" name="curp" id="curp" maxlength="20" style="width:200px;" /></td>
    	</tr>
        <tr>
        	<td>Sexo:</td>
        	<td>&nbsp;<select name="sexo" id="sexo" style="width:200px;">
            	<option value="M">MASCULINO</option>
                <option value="F">FEMENINO</option>
            </select>
            </td>
    	</tr>
        <tr>
        	<td>E-Mail:</td>
        	<td>&nbsp;<input type="text" name="mail" id="mail" maxlength="200" style="width:200px;" /></td>
    	</tr>
        <tr>
        	<td>Tel&eacute;fono:</td>
        	<td>&nbsp;<input type="text" name="tel" id="tel" maxlength="50" style="width:200px;" /></td>
    	</tr>
        <tr>
        	<td>Celular:</td>
        	<td>&nbsp;<input type="text" name="cel" id="cel" maxlength="50" style="width:200px;" /></td>
    	</tr>
	</table>
    <input type="hidden" name="idUsr" id="idUsr" value="<?=$id_usr?>" />
    <input type="hidden" name="accion" value="agrCand" />
	<br /> 
	<table border="0" align="center">
    	<tr>
            <td width="150px"></td>
            <td colspan="2" align="left">
            	<ul id="icons" class="ui-widget ui-helper-clearfix">
                	<li style="font-size:9px;" class="ui-state-default ui-corner-all" title="Guardar"><span class="ui-icon ui-icon-disk"></span><input type="submit" value="Guardar" class="botones" />&nbsp;</li>
                </ul>
            </td>
    	</tr>
	</table> 	
	</form>
    <div id="avisos"></div>
</div>
</body>