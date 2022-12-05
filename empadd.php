<?php require_once('empexaminator.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO Configsystem (descripcion, titulo, slogantxt, imagenjpg) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['slogantxt'], "text"),
                       GetSQLValueString($_POST['imagenjpg'], "text"));

  mysql_select_db($database_empexaminator, $empexaminator);
  $Result1 = mysql_query($insertSQL, $empexaminator) or die(mysql_error());

  $insertGoTo = "emplist.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <p><strong><center>
  <script>
function subirimagen(nombrecampo)
{
	self.name = 'opener';
	remote = open('gestionimagen.php?campo='+nombrecampo, 'remote', 'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
 	remote.focus();
	}

</script>
    <p>Agregar Empresa.</p>
    <p>&nbsp;</p>
  </center></strong></p>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre de Empresa:</td>
      <td><textarea name="titulo" cols="33"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Giro:</td>
      <td><input name="descripcion" type="text" value="" size="38" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Slogan:</td>
      <td><textarea name="slogantxt" cols="33"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Logotipo.jpg:</td>
      <td><input name="imagenjpg" type="text" value="" size="38" maxlength="100" />
      
 <ul id="icons" class="ui-widget ui-helper-clearfix">
        	
            <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-document"></span>
      <input type="button" id="ne" value="ElegirLogotipo" class="botones" onclick="javascript:subirimagen('imagenjpg');"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
      <ul id="icons" class="ui-widget ui-helper-clearfix">
          <p>&nbsp;</p>
          <li style="font-size:9px;" class="ui-state-default ui-corner-all" title=""><span class="ui-icon ui-icon-disk"></span>
         
      <input type="submit" id="ae" onclick="divToggle('contenido',$(this).attr('id'));" value="Guardar Empresa" class="botones" />
      
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
