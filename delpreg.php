<?php
	session_name('user_sesion');
	session_start();
	$id_usr = $_SESSION['id_usr'];
	if($id_usr!=""){
		include("conexion.php");
	}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
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

<body>
<form action="admin.php" method="post" id="frmEditPregunta" onsubmit="return verificaDelPregunta();">
  <table style="margin-top:5px;" border="0" align="center" id="tblFrmEditar">
  	<tr>
      <td align="left" valign="middle">Seleccione un pregunta a eliminar:</td>
      <td align="left" valign="middle">&nbsp;<select data-placeholder="Indique una pregunta..." id="seldesPregunta" class="chosen-select" style="width:200px;" name="idDelPre">
          <option value=""></option>
          <?php
					conectar("on");
					mysql_query("SET NAMES 'utf8'");
					$secciones = mysql_query('SELECT id_pregunta, pregunta FROM pregunta');
					if(mysql_num_rows($secciones) != 0){
						while($fila=mysql_fetch_array($secciones)){
							echo '<option value="'.$fila['id_pregunta'].'">'.$fila['pregunta'].'</option>'; 
						}
					}else{
						echo '<option value="">No hay preguntas</option>';
					}
					conectar("off");
				?>
        </select></td>
    </tr>
    <tr>
      <td colspan="2">
        	<br />
        	<p align="justify">
            	<strong>
                	<font color="#FF0000">
                		Se eliminar&aacute; la pregunta seleccionada. 
                    </font>
                </strong>
        	</p>
            <br />
        </td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle"><ul id="icons" class="ui-widget ui-helper-clearfix">
          <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-trash"></span><input type="submit"value="Eliminar" class="botones" />&nbsp;</li>
          <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=".ui-icon-closethick"><span class="ui-icon ui-icon-closethick"></span>
            <input type="reset" class="botones" value="Cancelar" onclick="divToggleCancelar('frmPreguntas');" />
          </li>
        </ul></td>
    </tr>
    <input type="hidden" name="accion" value="delPre" />
    <input type="hidden" name="idUsr" id="idUsr" value="<?=$id_usr?>" />
  </table>
</form>
<div id="avisosP"></div>
</body>
</html>