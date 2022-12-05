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
<form action="admin.php" method="post" id="frmDelExamenes" onsubmit="return verificaDelExamen();">
  <table style="margin-top:20px;" border="0" align="center" id="tblFrmEditar">
    <tr>
      <td align="left" valign="middle">Seleccione examen a eliminar:</td>
      <td align="left" valign="middle">&nbsp;<select data-placeholder="Indique un examen..." id="SelDelExamen" class="chosen-select" style="width:200px;" name="examen">
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
    	<td colspan="2">
        	<br />
        	<p align="justify">
            	<strong>
                	<font color="#FF0000">
                		Se eliminar&aacute; el examen, todas las secciones y todas las preguntas que pertenecen a este.
                    </font>
                </strong>
        	</p>
            <br />
        </td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle"><ul id="icons" class="ui-widget ui-helper-clearfix">
         <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-trash"></span><input type="submit"value="Eliminar" class="botones" />&nbsp;</li>
          <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-closethick"></span>
            <input type="reset" class="botones" value="Cancelar" onclick="divToggleCancelar('frmExamenes');" />
          </li>
        </ul></td>
    </tr>
    <input type="hidden" name="accion" value="delExam" />
    <input type="hidden" name="idUsr" id="idUsr" value="<?=$id_usr?>" />
  </table>
</form>
<div id="avisosE"></div>
</body>
</html>
