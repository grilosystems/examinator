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



<form action="admin.php" method="post" id="frmEditExamenes" onsubmit="return verificaExamen();">
  <table style="margin-top:20px;" border="0" align="center" id="tblFrmEditar">
    <tr>
      <td align="left" valign="middle">Seleccione examen:</td>
      <td align="left" valign="middle">&nbsp;<select data-placeholder="Indique un examen..." id="seldesExamen" class="chosen-select" style="width:200px;" name="examen" onChange="javascript:enviarDatos($(this).val(),'buscarExamen','frmEditExamenes');">
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
						echo '<option value="">No hay examenes</option>';
					}
					conectar("off");
				?>
        </select></td>
    </tr>
    <tr>
      <td>Nombre del examen:</td>
      <td><input type="text" id="nombre" name="nombreExamen" maxlength="50"  /></td>
    </tr>
    <tr>
      <td>Descripci&oacute;n:</td>
      <td><textarea id="des" name="description" onkeypress="return limitaTextarea(event,50,$(this).attr('id'));" rows="2" cols="25"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle"><ul id="icons" class="ui-widget ui-helper-clearfix">
          <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-disk"></span>
            <input type="submit" class="botones" value="Guardar" />
          </li>
          <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-closethick"></span>
            <input type="reset" class="botones" value="Cancelar" onclick="divToggleCancelar('frmExamenes');" />
          </li>
        </ul></td>
    </tr>
    <input type="hidden" name="accion" value="ediExam" />
    <input type="hidden" name="idUsr" id="idUsr" value="<?=$id_usr?>" />
  </table>
</form>
<div id="avisosE"></div>