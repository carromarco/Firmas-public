<html>
<head>
<link href="css/personal.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php 
	
	if ($_POST['preview'] == "1"){
		
	$legajo = $_POST['legajo'];
	$titulo = $_POST['titulo'];
	$nya = $_POST['nya'];
	$desc_costo = $_POST['desc_costo'];
	$tarea = $_POST['tarea'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$celular = $_POST['celular'];
	$email = $_POST['email'];
	$show_cel = $_POST['show_cel'];
	$ctro_costo = $_POST['ctro_costo'];
	
	if ($titulo == "--") $titulo ="";  else $titulo = $titulo." ";
	
	# 09/03/2015 a pedido de Silvina Cipollone se unifican los logos de Aluar Primario y Elaborados.
		
	#$imagen = "http://intranetba.afg.corp/img/firma_correo/logoaluar.jpg"; 
	
	$imagen ="data:image/jpeg;base64,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";
	
	# 30/07/2015 a pedido de Legales se agrega Sede social y R.P.C a todas las firmas
	
	# Se exceptua el cento de costo AL10100020 de Sede Social Marcelo T.-
	
	if ($ctro_costo ==	'AL10100020'){
		$sedesocial = "R.P.C. Nro. 2534, L&deg; 72, F&deg; 151, T&deg; \"A\" de Est. Nac., 26/06/1970";
		$rpc ='';
		}
	else {
		$sedesocial = "Sede Social: Marcelo T. de Alvear 590, piso 3&deg;, C.A.B.A.";
		$rpc = "R.P.C. Nro. 2534, L&deg; 72, F&deg; 151, T&deg; \"A\" de Est. Nac., 26/06/1970";
		}
	
				
	echo "<div align='center'><br>
	<fieldset style='width:45%;'>
	<form action='preview.php' method='POST' enctype='multipart/form-data' name='firma' target='preview'
	onsubmit=\"return confirm('Se enviar&aacute; un correo con su firma a la cuenta: ".$_POST['email']."\\n \\n Esta seguro que desea continuar?');\">
	<legend class='textonegrita'></legend>";
			
	echo "<br><table width='400px' border='0' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' rules='none'><tr>
    <td width='50' rowspan='9' align='center' valign='top' bgcolor='#FFFFFF'>
    <img src='".$imagen."' width='75' height='75' align='top'></td>
    <td height='20' style='font-family:Arial; font-size:12px; font-weight:bold; color:#333333' bgcolor='#FFFFFF'>".$titulo.$nya."</td>
	</tr><tr>
    <td height='14' style='font-family:Arial; font-size:11px; font-weight:bold; color:#666666;' bgcolor='#FFFFFF'>".$tarea."</td>
  	</tr>
  	<tr>
  	<td height='14' style='font-family:Arial; font-size:11px; font-weight:normal; color:#999999;' bgcolor='#FFFFFF'>".$desc_costo."</td>
  	</tr>
	<tr>
  	<td height='14' style='font-family:Arial; font-size:11px; font-weight:normal; color:#999999;' bgcolor='#FFFFFF'>".$direccion."</td>
  	</tr>
  	<tr>
    <td height='14' style='font-family:Arial; font-size:11px; font-weight:normal; color:#999999;' bgcolor='#FFFFFF'>".$telefono."</td>
  	</tr>";
  	    
  	echo "<tr>
    <td height='14' style='font-family:Arial; font-size:11px; font-weight:normal; color:#999999;' bgcolor='#FFFFFF'>E-mail: ".$email."</td>
  	</tr>
  	<tr>
  	  <td height='14' style='font-family:Arial; font-size:11px; color:#999999;' bgcolor='#FFFFFF'><span style='font-family:Arial; font-size:11px; font-weight:normal; color:#999999;'>".$sedesocial."</span></td>
  </tr>
  	<tr>
  	  <td height='14' style='font-family:Arial; font-size:11px; color:#999999;' bgcolor='#FFFFFF'><span style='font-family:Arial; font-size:11px; font-weight:normal; color:#999999;'>".$rpc."</span></td>
  </tr>
	</table>";
	
	echo "</fieldset><div align='right'>
	    		
	<input name='legajo' type='hidden' value='$legajo'>
	<input name='titulo' type='hidden' value='$titulo'>
	<input name='nya' type='hidden' value='$nya'>
	<input name='desc_costo' type='hidden' value='$desc_costo'>
	<input name='tarea' type='hidden' value='$tarea'>
	<input name='direccion' type='hidden' value='$direccion'>
	<input name='telefono' type='hidden' value='$telefono'>
	<input name='email' type='hidden' value='$email'>
	<input name='sedesocial' type='hidden' value='$sedesocial'>
	<input name='rpc' type='hidden' value='$rpc'>
	
	<input name='imagen' type='hidden' value='$imagen'>
	<input name='guardar' type='hidden' value='1'>
	
	<input name='button' type='submit' class='boton' id='button' value='Generar firma'>&nbsp;&nbsp;&nbsp;&nbsp;
	</div></div>
    </form>";
	}
			
	if ($_POST['guardar'] == "1"){

	$archivo_firma = "firmas/firma_".$_POST['legajo']."_".date('Ymd').".htm";
		
	$fp = fopen($archivo_firma, 'w')or die("Error no se ha podido generar la firma.");
	
	$firma_html = "<!DOCTYPE html>
<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'><p style='font-size:11px;'><br></p>
	<table border='0' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' rules='none'>
	<tr>
  <td height='16px' rowspan='8' align='center' valign='top'></td>
  <td height='16px' style='font-family:Arial; font-size:12px; font-weight:bold; color:#333333;'>&nbsp;</td>
</tr>
<tr>
  <td width='51' rowspan='8' align='center' valign='top'>
  <img src='data:image/jpeg;base64,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'/></td>
  <td height='16px' style='font-family:Arial; font-size:12px; font-weight:bold; color:#333333;'>".$_POST['titulo'].$_POST['nya']."</td>
</tr>
<tr>
  <td height='14px' style='font-family:Arial; font-size:11px; font-weight:bold; color:#666666;'>".$_POST['tarea']."</td>
</tr>
<tr>
  <td height='12px' style='font-family:Arial; font-size:11px; color:#999999;'>".$_POST['desc_costo']."</td>
</tr>
<tr>
  <td style='font-family:Arial; font-size:11px; color:#999999;'><br>".$_POST['direccion']."<br>
					".$_POST['telefono']."<br>
					".$_POST['email']."<br>
					</td>
</tr>
    <tr>
      <td style='font-family:Arial; font-size:11px; color:#999999;' bgcolor='#FFFFFF'><span style='font-family:Arial; font-size:11px; font-weight:normal; color:#999999;'>Sede Social: ".$_POST['sedesocial']."<br>
	  ".$_POST['rpc']."</span></td>
    </tr>
</table>";
		
	
	fwrite($fp, $firma_html);
	fclose($fp);
	
	function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
	
	$header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
	
	$nmessage .= "This is a multi-part message in MIME format.\r\n";
    $nmessage .= "--".$uid."\r\n";
    $nmessage .= "Content-type:text/html; charset=iso-8859-1\r\n";
    $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $nmessage .= $message."\r\n\r\n";
    $nmessage .= "--".$uid."\r\n";
    $nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $nmessage .= "Content-Transfer-Encoding: base64\r\n";
    $nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $nmessage .= $content."\r\n\r\n";
    $nmessage .= "--".$uid."--";
    
	if (mail($mailto, $subject, $nmessage, $header)) {
        echo "<center><br><br>
	<span class='texto'>Su firma personal ha sido creada exitosamente.</span>
	<br><br>
	<span class='textonormal'>Se envi&oacute; un correo a: <b>".$_POST['email']."</b> con el procedimiento para la inserci&oacute;n de su firma de correo en Lotus Notes 8.5 / IBM Notes 9.0.</span>
	</center>"; 
    } else {
        echo "Error enviando el mensaje";
    }
}

$adjunto = "firma_".$_POST['legajo']."_".date('Ymd').".htm";
$path = $_SERVER['DOCUMENT_ROOT']."/sistemas/firma_correo/aluar_v2/firmas/";
$autor = "Gestor de mensajeria Aluar";
$from = "noreply@aluar.com.ar";
$para = $_POST['email'];
$asunto = "Firma de correo de ".$_POST['nya'];

$ip=@ $_SERVER['REMOTE_ADDR'];
$host_full=gethostbyaddr($ip);

function host($host_full) 
	{      
	@list($si, $no) = split(".afg.corp",$host_full);      
	return $si;
	}
$host = host($host_full);

$hora_actual = date("H:i:s"); 
$fecha_actual = date("d/m/y");

$mensaje = "<h4 style='font-family:Tahoma, Geneva, sans-serif; font-size:12px; font-weight:bold; color:#369'>Gu&iacute;a para configurar la nueva firma de correo electr&oacute;nico:</h4>
<hr size='1' noshade>
<ul style='font-family:Tahoma, Geneva, sans-serif; font-size:12px; font-weight:normal; color:#333; '>
<p>1 - Con el bot&oacute;n derecho del mouse, hacer clic sobre el archivo adjunto que recibi&oacute; por mail.<br>
  <br>
  2 - Elegir la opci&oacute;n<strong> &quot;guardar&quot;</strong> para almacenar el archivo adjunto en una ubicaci&oacute;n conveniente.<br>
  <br>
  3 - Luego remitirse a la barra general de Lotus Notes (en la misma l&iacute;nea donde figura la opci&oacute;n &quot;Crear | Nuevo Mensaje&quot;, seleccione la opci&oacute;n <strong>&quot;M&aacute;s&quot; &raquo; &quot;Preferencias&quot; &raquo; &quot;Firma&quot;<br>
  </strong><br>
  4 - Hacer clic en el men&uacute; desplegable identificado con la letra <strong>&quot;T&quot;</strong>, seleccionar la opci&oacute;n <strong>&quot;Importar&quot;</strong><br>
  <br>
  5 - Buscar el archivo guardado y hacer clic en el bot&oacute;n<strong> &quot;Importar&quot;</strong>.<br />
  <br>
  6 - En caso que se requiera insertar la firma en todos los correos salientes, se deber&aacute; configurar tildando la opci&oacute;n <strong>&quot;incluir autom&aacute;ticamente una firma al final de los mensajes salientes&quot;</strong> y por &uacute;ltimo <strong>&quot;Aceptar&quot;</strong>.
</ul>
<br>
<p style='font-family:Tahoma, Geneva, sans-serif; font-size:12px; font-weight:normal; color:#333; '>Si tiene alg&uacute;n inconveniente para llevar a cabo estas acciones por favor comunicarse con la mesa de ayuda de su localidad a los internos: 3715 / 3722 / 3739 / 3748 (Puerto Madryn) - 8399 / 2131 / 2269 (San Fernando) - 7520/ 7635 / 7010 / 2269 (Abasto / Lugano).<br />
<hr size='1' noshade>
<span style='font-family:Tahoma, Geneva, sans-serif; font-size:11px; font-weight:normal; color:#333;'>Solicitud generada el ".$fecha_actual." (".$hora_actual.") desde ".strtoupper ($host)."   - Este mensaje es enviado autom&aacute;ticamente por el sistema, por favor no lo responda.</span>";

mail_attachment($adjunto, $path, $para, $from, $autor, $asunto, $mensaje);
	
}

?> 

</body>
</html>


