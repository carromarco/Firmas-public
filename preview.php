<?php

echo "<link rel='stylesheet' href='css/personal.css' type='text/css'>";
echo "<link rel='stylesheet' href='css/bootstrap.min.css' type='text/css'>";

echo "<div id='textoACopiar'>";

# print_r($_POST);

	if ($_POST ['showpreview'] == TRUE){
				
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
				
				if ($titulo == "--") { $titulo =""; } else { $titulo = $titulo." "; }
				
				# 09/03/2015 a pedido de Silvina Cipollone se unifican los logos de Aluar Primario y Elaborados.
				#Logo de Aluar png (sin fondo) y codificado a BASE64
		
				$imagen = "data:image/png;base64,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";
				
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
				
				echo "<div align='center'>";

				echo "<table width='600px' border='0' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' rules='none' style='margin-top: 40px; line-height:1.1;'><tr>
				<td width='50' rowspan='9' align='center' valign='top' bgcolor='#FFFFFF'>
				<img src='".$imagen."' width='50' height='50' align='top' style='margin-top: 5px; margin-right: 15px;'></td>
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
				
				</div></div>
				</form>";
					
			echo $firma_html;
			
			echo "</div><br>";
			
			echo "<div id='alerta' class='invisible'></div>";
			
			echo "<button id='btnCopiar' class='boton' style='position: absolute;top: 82%;'>Copiar al portapapeles</button>";
    
			#echo "<Div><a href='https://aluarcomar.sharepoint.com/:b:/s/CapacitacionMicrosoft365/EQ7lQfTGuRhFnJz8DVoFi3EBLo7NYGdQlW4nUlPf6XoVSg?e=BBXA7l' target='_blank'><button id='descargar' class='boton' style='position: absolute;bottom: 10px;right: 10px;'>Ver Instructivo</button></a></Div>";
			
	}

?>
	
<script>
			document.addEventListener("DOMContentLoaded", function () {
				//Asigno el evento "click" del botón para provocar el copiado
				document.getElementById('btnCopiar').addEventListener('click', copiarAlPortapapeles);
			});

			//Función que lanza el copiado del código
			function copiarAlPortapapeles() {
				var codigoACopiar = document.getElementById('textoACopiar');
				var seleccion = document.createRange();
				seleccion.selectNodeContents(codigoACopiar);
				window.getSelection().removeAllRanges();
				window.getSelection().addRange(seleccion);

				try {
					var res = document.execCommand('copy');
					if (res)
						exito();
					else
						fracaso();
					mostrarAlerta();
				} catch (ex) {
					excepcion();
				}
				window.getSelection().removeRange(seleccion);
			}

			///////
			// Auxiliares para mostrar y ocultar mensajes
			///////
			var divAlerta = document.getElementById('alerta');

			function exito() {
				divAlerta.innerText = '  Firma copiada al portapapeles, siga las instrucciones -->';
				divAlerta.classList.add('alert-success');        }

			function fracaso() {
				divAlerta.innerText = '¡¡Ha fallado el copiado al portapapeles!!';
				divAlerta.classList.add('alert-warning');
			}

			function excepcion() {
				divAlerta.innerText = 'Se ha producido un error al copiar al portapaples';
				divAlerta.classList.add('alert-danger');
			}

			function mostrarAlerta() {
				divAlerta.classList.remove('invisible');
				divAlerta.classList.add('visible');
				setTimeout(ocultarAlerta, 360000);
			}

			function ocultarAlerta() {
				divAlerta.innerText = '';
				divAlerta.classList.remove('alert-success', 'alert-warning', 'alert-danger', 'visible');
				divAlerta.classList.add('invisible');
			}

</script>		



