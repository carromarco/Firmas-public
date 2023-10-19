<!DOCTYPE html>
<head>
<title>Formulario de creaci&oacute;n de firma de correo - Aluar</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="image/x-icon" href="images/favicon.ico" rel="icon">
<link type="image/x-icon" href="images/favicon.ico" rel="shortcut icon">
<link href="css/personal.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="document.CheqLegajo.legajo.focus()" bgcolor="#BED6EB">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="2" bordercolor="#cccccc"  bgcolor="#ffffff">
<tr>
<td height="35" colspan="3" background="images/encabezado_fondo.jpg" bordercolor="#FFF">
<img src="images/encabezado.jpg" width="533" height="80" border="0"></td>
</tr>
<tr>
<td width="1px" rowspan="3" valign="top">&nbsp;</td>
</tr>
<tr>
<td height="230" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" style="padding-left:5px; padding-right:5px;"><br>
<form name="CheqLegajo" method="POST" action="form.php" target="form">
<fieldset>
<legend class="texto_titular">Formulario para la generación de firma de correo electrónico:&nbsp;</legend>

<fieldset style="width:95%;"><br>
  <legend class="textonegrita">Legajo del solicitante:&nbsp;</legend>
      <label>
      <span class="edicion">Ingrese su número de legajo (Ej. 89765):&nbsp;</span>
      <input name="legajo" type="text" class="box" id="legajo" size="8" maxlength="5">
      </label>&nbsp;&nbsp;
      <input name="Comprobar" type="hidden" value="si">
      <input type="submit" class="boton" value="Comprobar">
  </fieldset><br>

<iframe name="form" src="form.php" width="95%" frameborder="0"scrolling="no" height="460px"></iframe>
</form>
</legend><td width="1px" rowspan="3" valign="top">&nbsp;</td>
<tr>
<td width="1px" colspan="2" rowspan="3" valign="top">&nbsp;</td>
</tr>
</table>
<? include ("include/inc.footer.php"); ?>


</body>
</html>