<?php
	session_name('user_sesion');
	session_start();
	$id_usr = $_SESSION['id_usr'];
	if($id_usr!=""){
		include("conexion.php");
	}
?><head>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
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



<form action="admin.php" method="post" id="frmNPregunta" onsubmit="return verificaPregunta();">
  <table style="margin-top:20px;" border="0" align="center" id="tblFrmEditar">
  <tr>
      <td align="left" valign="middle">Seleccione secci&oacute;n:</td>
      <td align="left" valign="middle">&nbsp;<select data-placeholder="Indique una secci&oacute;n..." id="seldesSeccionP" class="chosen-select" style="width:200px;" name="idSeccionP">
          <option value=""></option>
          <?php
					conectar("on");
					mysql_query("SET NAMES 'utf8'");
					$secciones = mysql_query('SELECT id_seccion, nombre_seccion FROM seccion');
					if(mysql_num_rows($secciones) != 0){
						while($fila=mysql_fetch_array($secciones)){
							echo '<option value="'.$fila['id_seccion'].'">'.$fila['nombre_seccion'].'</option>'; 
						}
					}else{
						echo '<option value="">No hay secciones</option>';
					}
					conectar("off");
				?>
        </select></td>
    </tr>
    <tr>
      <td>Escriba la pregunta:</td>
      <td><textarea name="pregunta" cols="30" rows="5" id="pregunta"></textarea></td>
    </tr>
    <tr>
      <td colspan="2">Indique las cuatro respuestas:</td>
     </tr>
     <tr>
      <td valign="middle"><input type="radio" id="r1" name="nrc" value="r1" />&nbsp;Respuesta 1:</td>
      <td valign="middle"><input name="nr1" type="text" id="nr1" /></td>
     </tr>
     <tr>
      <td valign="middle"><input type="radio" id="r2" name="nrc" value="r2" />&nbsp;Respuesta 2:</td>
      <td valign="middle"><input type="text" id="nr2" name="nr2" /></td>
     </tr>
     <tr>
      <td valign="middle"><input type="radio" id="r3" name="nrc" value="r3" />&nbsp;Respuesta 3:</td>
      <td valign="middle"><input type="text" id="nr3" name="nr3" /></td>
     </tr>
     <tr>
      <td valign="middle"><input type="radio" id="r4" name="nrc" value="r1" />&nbsp;Respuesta 4:</td>
      <td valign="middle"><input type="text" id="nr4" name="nr4" /></td>
    </tr>
    <tr>
    	<td><input type="hidden" id="respcor" name="respcor" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle"><ul id="icons" class="ui-widget ui-helper-clearfix">
          <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=".ui-icon-disk"><span class="ui-icon ui-icon-disk"></span>
            <input type="submit" onClick="revResp();" class="botones" value="Guardar" />
          </li>
          <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=".ui-icon-closethick"><span class="ui-icon ui-icon-closethick"></span>
            <input type="reset" class="botones" onclick="divToggleCancelar('frmPreguntas');" value="Cancelar" />
          </li>
        </ul></td>
    </tr>
    <input type="hidden" name="accion" value="agrPre" />
    <input type="hidden" name="idUsr" id="idUsr" value="<?=$id_usr?>" />
  </table>
</form>
<div id="avisosP"></div>