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
});
</script>
<link rel="stylesheet" href="css/chosen.css">
</head>



<form action="admin.php" method="post" id="frmAgrExamenes" onsubmit="return verificaExamen();">
  <table align="center" style="margin-top:30px;" id="tblFrmExam">
    <tr>
      <td>Nombre del examen:</td>
      <td><input type="text" id="nombre" name="nombreExamen" maxlength="50"  /></td>
    </tr>
    <tr>
      <td>Descripci&oacute;n:</td>
      <td><textarea id="des" name="description" onkeypress="return limitaTextarea(event,50,'des')" rows="2" cols="25"></textarea></td>
    </tr>
    <tr>
    	<td align="center" colspan="2">
    		<ul id="icons" class="ui-widget ui-helper-clearfix">
        		<li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-disk"></span><input type="submit" class="botones" value="Guardar" /></li>
          		<li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-closethick"></span><input type="reset" class="botones" value="Cancelar" onclick="divToggleCancelar('frmExamenes');" /></li>
        	</ul>
     	</td>
    </tr>
  </table>
  <input type="hidden" name="accion" value="agrExam" />
  <input type="hidden" name="idUsr" id="idUsr" value="<?=$id_usr?>" />
</form>
<div id="avisosE"></div>