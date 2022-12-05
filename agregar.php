<?php
	include("conexion.php");
	session_name('user_sesion');
	session_start();
	if(isset($_SESSION['usr_ses']) && isset($_SESSION['id_usr'])){
		$id_usr = $_SESSION['id_usr'];
	}else{
		header('Location: index.html');
	}
?>
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
<body>
<div style=" margin-top:5px; margin-left:50px; border:0px solid #000; width:500px; height:370px;">
    <fieldset style="border:2px double #CCC; text-align:center;">
      <legend>&nbsp;Ex&aacute;menes&nbsp;</legend>
      	&nbsp;
      	<ul id="icons" class="ui-widget ui-helper-clearfix">
        	<center>
            <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-document"></span><input type="button" id="ne" value="Nuevo examen" class="botones" onClick="divToggle('frmExamenes',$(this).attr('id'));" />&nbsp;</li>
            <li  style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-pencil"></span><input type="button" id="ee" value="Editar examen" class="botones" onClick="divToggle('frmExamenes',$(this).attr('id'));" />&nbsp;</li>
            <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-trash"></span><input type="button" id="de" value="Eliminar examen" class="botones" onClick="divToggle('frmExamenes',$(this).attr('id'));" />&nbsp;</li>
            </center>
        </ul>
        &nbsp;
    </fieldset>
    <div id="frmExamenes" ></div>
    <br />
    <fieldset style="border:2px double #CCC; text-align:center;">
      <legend>&nbsp;Secciones&nbsp;</legend>
       &nbsp;
      	<ul id="icons" class="ui-widget ui-helper-clearfix">
        	<center>
            <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-document"></span><input type="button" id="ns" value="Nueva secci&oacute;n" class="botones" onClick="divToggle('frmSecciones',$(this).attr('id'));" />&nbsp;</li>
            <li  style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-pencil"></span><input type="button" id="es" value="Editar secci&oacute;n" class="botones" onClick="divToggle('frmSecciones',$(this).attr('id'));" />&nbsp;</li>
            <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-trash"></span><input type="button" id="ds" value="Eliminar secci&oacute;n" class="botones" onClick="divToggle('frmSecciones',$(this).attr('id'));" />&nbsp;</li>
            </center>
        </ul>
        &nbsp;
    </fieldset>
    <div id="frmSecciones" class="frmsDivsH"></div>
    <br />
    <fieldset style="border:2px double #CCC; text-align:center;">
      <legend>&nbsp;Preguntas&nbsp;</legend>
       &nbsp;
      	<ul id="icons" class="ui-widget ui-helper-clearfix">
        	<center>
            <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-document"></span><input type="button" id="np" value="Nueva pregunta" class="botones" onClick="divToggle('frmPreguntas',$(this).attr('id'));" />&nbsp;</li>
            <li  style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-pencil"></span><input type="button" id="ep" value="Editar pregunta" class="botones" onClick="divToggle('frmPreguntas',$(this).attr('id'));" />&nbsp;</li>
            <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-trash"></span><input type="button" id="dp" value="Eliminar pregunta" class="botones" onClick="divToggle('frmPreguntas',$(this).attr('id'));" />&nbsp;</li>
            </center>
        </ul>
        &nbsp;
    </fieldset>
    <div id="frmPreguntas" class="frmsDivsH">
    	
    </div>
</div>
</body>