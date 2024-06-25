<?php

include ("include/inc.define.php");

echo "<link href='css/personal.css' rel='stylesheet' type='text/css'>";

#print_r($_POST);

if ($_POST['Comprobar'] == 'si')
{
$dato_nu = trim ($_POST['legajo']);

	if (!is_numeric($dato_nu))
		{
		echo "<table width='98%' border='0' cellspacing='0' cellpadding='0'>
  		<tr>
        <td><fieldset><legend class='textonegrita'>Error&nbsp;&nbsp;</legend>
		<span class='textoerror'><center>El legajo ingresado debe ser num�rico, no puede incluir letras.</center></span>
		</fieldset></td>
  		</tr>
	  </table>";
		}
	else {
			
	$conn = oci_connect($usuario, $clave, $db10);
							
	$sql_met4 = OCIParse($conn,"select to_number(U.L_EMPLEADO_ALU) as LEGAJO, initcap (u.x_nombre) as NOMBRES, initcap (u.x_apellido) as APELLIDO, initcap (u.x_uo ) as DESC_COSTO, u.c_div_empresa   as CTRO_TRAB, initcap( u.x_posicion ) as TAREA, initcap (u.x_uo) as N_UNIDAD, initcap(O.X_UO) as UNIDAD_JEFE,
    initcap ( O.X_UO_SUP)  as UNIDAD_GCIA, v.email AS EMAIL, u.c_familia_fun as C_PUESTO, u.id_ctro_costo  as CTRO_COSTO       
		from NU0.temail v, SAPPI_TPERSONAL U, SAPPI_TORGANIGRAMA O
       where U.L_EMPLEADO_ALU  = v.legajo
       and to_number(U.L_EMPLEADO_ALU) = '".$dato_nu."'
       and u.c_empresa  = 'ALUAR'
       and ((u.c_tipo = '1') or (u.c_div_empresa = 'ABASTO'))           
       and U.L_EMPLEADO_ALU < 95000
       and (u.f_baja is null or u.f_baja > SYSDATE)
       and U.ID_DEPARTAMENTO = O.ID_UO");
							
	OCIDefineByName($sql_met4,"LEGAJO",$legajo);
	OCIDefineByName($sql_met4,"NOMBRES",$nombres);
	OCIDefineByName($sql_met4,"APELLIDO",$apellido);
	OCIDefineByName($sql_met4,"DESC_COSTO",$desc_costo);
	OCIDefineByName($sql_met4,"CTRO_TRAB",$ctro_trab);
	OCIDefineByName($sql_met4,"TAREA",$tarea);
	OCIDefineByName($sql_met4,"N_UNIDAD",$n_unidad);
	OCIDefineByName($sql_met4,"UNIDAD_JEFE",$n_unidad_jefe);
	OCIDefineByName($sql_met4,"UNIDAD_GCIA",$n_unidad_gcia);
	OCIDefineByName($sql_met4,"EMAIL",$email);
	OCIDefineByName($sql_met4,"C_PUESTO",$c_puesto);
	OCIDefineByName($sql_met4,"CTRO_COSTO",$ctro_costo);
					
	OCIExecute($sql_met4);
	OCIFetch($sql_met4);

	$sql_tel = OCIParse($conn,"select interno as INTERNO, directo as DIRECTO from nu0.tlegajo_te where legajo = '".$dato_nu."'");

	@OCIDefineByName($sql_tel,"INTERNO",$interno);
	@OCIDefineByName($sql_tel,"DIRECTO",$celular);
	
	@OCIExecute($sql_tel);
	@OCIFetch($sql_tel);
	
		if (!$legajo){ 

		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  		<tr>
        <td><fieldset><legend class='textonegrita'>Error</legend>
		<span class='textoerror'><center>El legajo ingresado es incorrecto.<br><br>Esto puede deberse a que ingres� un legajo inexistente o la cuenta asociada a ese legajo no esta dentro del grupo de usuarios autorizados.<br><br></center></span>
		</fieldset></td>
  		</tr>
		</table>";
		
		}
		else {
		
		$nya = htmlentities($nombres, ENT_QUOTES)." ". htmlentities($apellido, ENT_QUOTES);
						
		if (($tarea == "-") and (($ctro_trab == "MADRYNPRIM") or ($ctro_trab == "MADRYNSEMI"))) { $tarea = "Operador"; }
						
		$tarea = str_replace("Jr.", "", $tarea);
		$tarea = str_replace("S. Sr.", "", $tarea);
		$tarea = str_replace("Sr.", "", $tarea);
		$tarea = str_replace("Pcpal.", "", $tarea);
		$tarea = str_replace("Ppal", "Pcpal.", $tarea);
		$tarea = str_replace("Ctrol", "Control", $tarea);
		$tarea = str_replace("Distribuc.", "Distribuci�n", $tarea);
		$tarea = str_replace("1� Cat.", "", $tarea);
		$tarea = str_replace("2� Cat.", "", $tarea);
		
		$tarea = str_replace("Adm.", "Admin.", $tarea);
		$tarea = str_replace("Adm.", "Admin.", $tarea);
		$tarea = str_replace("Admministrativo", "Administrativo", $tarea);
		
		$tarea = str_replace("Anal. Instrumental", "Instrumental", $tarea);
		$tarea = str_replace("Anal.", "Analista", $tarea);
		$tarea = str_replace("Asist.", "Asistente", $tarea);
		$tarea = str_replace("Coord.", "Coordinador", $tarea);
		$tarea = str_replace("Coord ", "Coordinador ", $tarea);
		$tarea = str_replace("Superv.", "Supervisor", $tarea);
		$tarea = str_replace("Mant.", "Mantenimiento", $tarea);
		$tarea = str_replace("Medico", "M�dico", $tarea);
		$tarea = str_replace("Serv Auxil", "Serv. Auxiliares", $tarea);
		$tarea = str_replace("Industr.", "Industrial", $tarea);
		$tarea = str_replace("Lider", "L�der", $tarea);
		$tarea = str_replace("Electrico", "El�ctrico", $tarea);
		$tarea = str_replace("Mecanico", "Mec�nico", $tarea);
		$tarea = str_replace("Tecnico", "T�cnico", $tarea);
		$tarea = str_replace("Redes", "Telecomunicaciones", $tarea);
		$tarea = str_replace("Ingeniero En Telecomunicaciones", "Analista en Telecomunicaciones", $tarea);					
		$tarea = str_replace("Compens.", "Compensaciones", $tarea);
		$tarea = str_replace("Rrhh", "Recursos Humanos", $tarea);
		$tarea = str_replace("Rrii", "Relaciones Industriales", $tarea);
		$tarea = str_replace("Instrumentacion", "Instrumentaci�n", $tarea);
		$tarea = str_replace("Code", "Conversi�n El�ctrica", $tarea);
		$tarea = str_replace("Geel", "Generaci�n El�ctrica", $tarea);
		$tarea = str_replace("Caii", "Control de Calidad", $tarea);
		$tarea = str_replace("- Sistemas -", "de Sistemas", $tarea);
		$tarea = str_replace("Facturacion", "Facturaci�n", $tarea);
		$tarea = str_replace("Informacion ", "Informaci�n ", $tarea);
		$tarea = str_replace("Ingenieria", "Ingenier�a", $tarea);
		$tarea = str_replace("Gestion", "Gesti�n", $tarea);
		$tarea = str_replace("Credito", "Cr�dito", $tarea);
		$tarea = str_replace("Logistica", "Log�stica", $tarea);
		$tarea = str_replace("Produccion", "Producci�n", $tarea);
		$tarea = str_replace("Expedicion", "Expedici�n", $tarea);
		$tarea = str_replace("Recepcion", "Recepci�n", $tarea);
		$tarea = str_replace("Economico", "Econ�mico", $tarea);
		$tarea = str_replace("Extrusion", "Extrusi�n", $tarea);
		$tarea = str_replace("Reduccion", "Reducci�n", $tarea);
		$tarea = str_replace("Energia", " Energ�a", $tarea);	
		$tarea = str_replace("Administracion", "Administraci�n", $tarea);
		$tarea = str_replace("Planificacion", "Planificaci�n", $tarea);	
		$tarea = str_replace("Tecnologia", "Tecnolog�a", $tarea);
		$tarea = str_replace("Informatica", "Inform�tica", $tarea);
		$tarea = str_replace("Dpse", "Semielaborados", $tarea);
		$tarea = str_replace("Dpse Ii", "Semielaborados II", $tarea);
		$tarea = str_replace("Dpse I", "Semielaborados", $tarea);	
		$tarea = str_replace("Cctv", "Ctro. de Control de Video", $tarea);
		$tarea = str_replace(" De ", " de ", $tarea);
		$tarea = str_replace(" Del ", " del ", $tarea);
		$tarea = str_replace(" En ", " en ", $tarea);
		$tarea = str_replace(" Y ", " y ", $tarea);
		$tarea = str_replace(" E ", " e ", $tarea);
		$tarea = str_replace(" A ", " a ", $tarea);
		$tarea = str_replace(" b ", " B ", $tarea);
		$tarea = str_replace("Series a y B", "Series A y B", $tarea);
		$tarea = str_replace("CoordinadorCapacitaci�n", "Coordinador de Capacitaci�n", $tarea);
		$tarea = str_replace("CoordinadorGmp Manten. Electr./Electronico", "Coordinador de Mantenimiento El�ctrico", $tarea);
		$tarea = str_replace("Telecomunicaciones, Proyectos e Infr.Telecom", "Telecomunicaciones", $tarea);
		$tarea = str_replace("Juridicos", "Jur�dicos", $tarea);
		$tarea = str_replace("Almacen ", "Almac�n ", $tarea);
		$tarea = str_replace("Fundicion", "Fundici�n", $tarea);
		
		if ($legajo == '23293'){ $tarea = "Analista en Telecomunicaciones"; }
		if ($legajo == '22358'){ $tarea = "Analista de Tecnolog�a Inform�tica"; }
			
		
		$isjefe = strpos($c_puesto,'JEF');

		if($isjefe !== FALSE){
    		$jefeoasist = '1';
			}
			else {
			$jefeoasist = '0'; 
			}
				
		$directoPM = "Tel: +54 280 445-9000";
		$direccionPM = "<br>ALUAR ALUMINIO ARGENTINO S.A.I.C.<br>
					Parque Industrial Pesado � U9120OIA<br>
					Puerto Madryn � Chubut � Argentina";
			
		$directoSF = "Tel: +54 11 4725-8000";
		$direccionSF = "<br>ALUAR ALUMINIO ARGENTINO S.A.I.C.<br>
					Pasteur 4600 � B1644AMV<br>
					Victoria � Buenos Aires � Argentina";
		
		$directoAB = "Tel: +54 11 4725-8000";
		$direccionAB = "<br>ALUAR ALUMINIO ARGENTINO S.A.I.C.<br>
					DIVISION ELABORADOS<BR>
					Ruta Prov. 2 Km. 54 � B1933BWA<br>
					Abasto � Buenos Aires � Argentina";
		
		$directoADE = "Tel: +54 11 4725-8000";
		$direccionADE = "<br>ALUAR ALUMINIO ARGENTINO S.A.I.C.<br>
					DIVISION ELABORADOS<BR>
					Pasteur 4600 � B1644AMV<br>
					Victoria � Buenos Aires � Argentina";
		
		$directoSS = "Tel: +54 11 4311-8911";
		$direccionSS = "<br>ALUAR ALUMINIO ARGENTINO S.A.I.C.<br>
					SEDE SOCIAL<BR>
					Marcelo T. de Alvear 590, 3� Piso � C1058AAF<br>
					Capital Federal � Buenos Aires � Argentina";

		if ($interno !=""){ $interno = " - Ext. ".$interno; }
		
		# Se agrega para sacar de la descripcion de departamento el "SIST -" Dpto de Sistemas y quede solo "Dpto de Sistemas"
		
		$pos = strpos($n_unidad_jefe, '-');
		
		if ($pos == 5){
		
		$n_unidad_jefe = substr($n_unidad_jefe, 7);
		
		}
		
		# Se agrega para sacar de la descripcion de gerencia ej. GEAN -"
		
		$pos = strpos($n_unidad_gcia, '-');
		
		if ($pos == 5){
		
		$n_unidad_gcia = substr($n_unidad_gcia, 7);
		
		}
		
		$n_unidad_jefe = str_replace("A Y B", "A y B", $n_unidad_jefe);
		$n_unidad_jefe = str_replace(" A ", " a ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace(" Al ", " al ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace(" Y ", " y ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("&", " y ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace(" E ", " e ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace(" De ", " de ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace(" Del ", " del ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace(" Ii", "", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("( Pmo )", "", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Direccion", "Direcci�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Indust.", "Industrial", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Energia", " Energ�a", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Ctrol ", "Control ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Distribuci�n Energ�a", "Distribuci�n de Energ�a", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Generaci�n Energ�a", "Generaci�n de Energ�a", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Gerencia Investigaci�n", "Gerencia de Investigaci�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Gcia ", "Gcia. ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Gcia. ", "Gerencia ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Semielaborados 1", "Semielaborados", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Semielaborados 2", "Semielaborados II", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Sistemas Puerto Madryn", "de Sistemas", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Administracion", "Administraci�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Procedimiento", "Procedimientos", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Coordinacion", "Coordinaci�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Planificacion", "Planificaci�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Serv.", "Servicios", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Proteccion ", "Protecci�n ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Mantenim ", "Mantenimiento ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Mantenim.", "Mantenimiento", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Gestion", "Gesti�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Credito", "Cr�dito", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Tecnic", "T�cnic", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Economico", "Econ�mico", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Extrusion", "Extrusi�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Atencion", "Atenci�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Proc. de Reduccion", "Procesos de Reducci�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Electroquimicos", "Electroqu�micos", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Automacion", "Automaci�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Depto ", "Dpto. ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Logistica", "Log�stica", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Electrico", "El�ctrico", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Electronico", "Electr�nico", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Tecnologia", "Tecnolog�a", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Informatica", "Inform�tica", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Instrumentacion", "Instrumentaci�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Investigacion", "Investigaci�n", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Juridico", "Jur�dico", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Series a y B", "Series A y B", $n_unidad_jefe);
								
		if (strlen($n_unidad_jefe) < 40){
		$n_unidad_jefe = str_replace("Dpto.", "Departamento", $n_unidad_jefe); 	}
		
		if (strlen($n_unidad_jefe) > 40){
		$n_unidad_jefe = str_replace("Gerencia", "Gcia.", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Departamento","Dpto.", $n_unidad_jefe);	}		
		
		$n_unidad_gcia = str_replace(" Y ", " y ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace(" E ", " e ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace(" A ", " a ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace(" De ", " de ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace(" Del ", " del ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("�", "A", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Analistas Sf", "Aplicaciones Comerciales y Log�sticas", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Gerencia Investigaci�n", "Gerencia de Investigaci�n", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Gerencia Planeamiento", "Gerencia de Planeamiento", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Planificacion", "Planificaci�n", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Extrusion", "Extrusi�n", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Tecnic", "T�cnic", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Tecnologia ", "Tecnolog�a ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Informatica", "Inform�tica", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Informacion ", "Informaci�n ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Investigacion", "Investigaci�n", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Direccion ", "Direcci�n ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Gestion", "Gesti�n", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Facturacion ", "Facturaci�n ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Mantenim.", "Mantenimiento", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Energeticos", "Energ�ticos", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Redes", "Proyectos e Infraestructura de Telecomunicaciones", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Redes, Proy. e Infraestruct. de Telecom.", "Proyectos e Infraestructura de Telecomunicaciones", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Administracion ", "Administraci�n ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Desarr. de Prod.", "Desarrollo de Producto", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Serv. Comp. de Administ.", "Serv. Compartidos de Admin. del", $n_unidad_gcia);	
		$n_unidad_gcia = str_replace("Energia", "Energ�a", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Depto ", "Dpto. ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Depto ", "Dpto. ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Rrhh", "RRHH", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Administracion ", "Administraci�n ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Desarr. de Prod.", "Desarrollo de Producto", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Serv. Comp. de Administ.", "Serv. Compartidos de Admin. del", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Energia", "Energ�a", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Depto ", "Dpto. ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Gcia ", "Gcia. ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Gcia. ", "Gerencia ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Rrhh", "RRHH", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Juridico", "Jur�dico", $n_unidad_gcia);
				
		if (strlen($n_unidad_gcia) > 35){
		$n_unidad_gcia = str_replace("Gerencia", "Gcia.", $n_unidad_gcia); }
				
		$desc_costo = str_replace(" Y ", " y ", $desc_costo);
		$desc_costo = str_replace(" A ", " a ", $desc_costo);
		$desc_costo = str_replace(" E ", " e ", $desc_costo);
		$desc_costo = str_replace(" Al ", " al ", $desc_costo);
		$desc_costo = str_replace(" De ", " de ", $desc_costo);
		$desc_costo = str_replace("Dep.", "Departamento", $desc_costo);
		$desc_costo = str_replace("Depto.", "Departamento", $desc_costo);
		$desc_costo = str_replace("Depto", "Departamento", $desc_costo);
		$desc_costo = str_replace("Coordinacion", "Coordinaci�n", $desc_costo);
		$desc_costo = str_replace("Direccion", "Direcci�n", $desc_costo);
		$desc_costo = str_replace("Planeam ", "Planeamiento ", $desc_costo);
		$desc_costo = str_replace("Rr.Hh", "RRHH", $desc_costo);
		$desc_costo = str_replace("Rrhh", "RRHH", $desc_costo);
		$desc_costo = str_replace("( Pmo )", "PMO", $desc_costo);
		$desc_costo = str_replace("Ade", "ADE", $desc_costo);
		$desc_costo = str_replace("ADE I", "ADE", $desc_costo);
		$desc_costo = str_replace("Redes", "Proyectos e Infraestructura de Telecomunicaciones", $desc_costo);
		$desc_costo = str_replace("Redes, Proy. e Infraestruct. de Telecom.", "Proyectos e Infraestructura de Telecomunicaciones", $desc_costo);
		$desc_costo = str_replace("Gcia.De", "Gcia. de", $desc_costo);
		$desc_costo = str_replace("Lider de Tecnolog�a", "Tecnolog�a Inform�tica", $desc_costo);
		$desc_costo = str_replace("Extrusion", "Extrusi�n", $desc_costo);
		$desc_costo = str_replace("Fundicion", "Fundici�n", $desc_costo);
		$desc_costo = str_replace("Laminacion", "Laminaci�n", $desc_costo);
		$desc_costo = str_replace("Capacitacion", "Capacitaci�n", $desc_costo);
		$desc_costo = str_replace("Programacion", "Programaci�n", $desc_costo);
		$desc_costo = str_replace("Planificacion", "Planificaci�n", $desc_costo);
		$desc_costo = str_replace("Administracion", "Administraci�n", $desc_costo);
		$desc_costo = str_replace("Investigacion", "Investigaci�n", $desc_costo);
		$desc_costo = str_replace("Energia", "Energ�a", $desc_costo);
		$desc_costo = str_replace("Energetico", "Energ�tico", $desc_costo);
		$desc_costo = str_replace("Mantenim ", "Mantenimiento ", $desc_costo);
		$desc_costo = str_replace("Gestion", "Gesti�n", $desc_costo);
		$desc_costo = str_replace("Tecnic", "T�cnic", $desc_costo);
		$desc_costo = str_replace("Economico", "Econ�mico", $desc_costo);
		$desc_costo = str_replace("Atencion", "Atenci�n", $desc_costo);
		$desc_costo = str_replace("Mecanico", "Mec�nico", $desc_costo);
		$desc_costo = str_replace("Analistas Sf", "Aplicaciones Planta San Fernando", $desc_costo);
		$desc_costo = str_replace("Tecnologia ", "Tecnolog�a ", $desc_costo);
		$desc_costo = str_replace("Informatica", "Inform�tica", $desc_costo);
		$desc_costo = str_replace("Facturacion", "Facturaci�n", $desc_costo);
		$desc_costo = str_replace("Juridico", "Jur�dico", $desc_costo);
		$n_unidad_gcia = str_replace("Logistica", "Log�stica", $n_unidad_gcia);
		
		if (strlen($desc_costo) < 35){
		$desc_costo = str_replace("Dpto.", "Departamento", $desc_costo); 	}
		
		if (strlen($desc_costo) > 35){
		$desc_costo = str_replace("Gerencia", "Gcia.", $desc_costo);
		$desc_costo = str_replace("Departamento","Dpto.", $desc_costo);	}
								
	
	echo "<fieldset style='width:98%;'>
	<legend class='textonegrita' >Datos personales del solicitante</legend>
	
		<form name='firma' action='preview.php' method='POST' target='preview'>
	
		<table width='100%' border='0' cellpadding='4' cellspacing='2'><tr>
		<td width='8%' class='textoform' align='right'>Nombre:</td>
		<td>";
	
	echo "<input name='nya' type='text' class='box2' id='nya' value='".$nya."' size='30' onchange='this.form.submit()'>
    <td width='10%' align='right' class='textoform'>Tel&eacute;fono:</td>        
        <td>";
	
	if (($ctro_trab == "MADRYNPRIM") or ($ctro_trab == "MADRYNSEMI")) {
	
	echo "<select name='telefono' id='telefono' class='box2' onchange='this.form.submit()'>
	      <option value ='$directoPM$interno'>".$directoPM.$interno."</option>
		  <option value ='$directoSF$interno'>".$directoSF.$interno."</option>
        </select>";
	}
	
	if ($ctro_trab == "SFERNAPRIM") {
	
	echo "<select name='telefono' id='telefono' class='box2' onchange='this.form.submit()'>
	      <option value ='$directoSF$interno'>".$directoSF.$interno."</option>
		  <option value ='$directoAB$interno'>".$directoAB.$interno."</option>
		  <option value ='$directoADE$interno'>".$directoADE.$interno."</option>
		  <option value ='$directoSS$interno'>".$directoSS.$interno."</option>
        </select>";
	}
	if ($ctro_trab == "LUGANO") {
	
	echo "<select name='telefono' id='telefono' class='box2' onchange='this.form.submit()'>
		  <option value ='$directoSF$interno'>".$directoSF.$interno."</option>
		  <option value ='$directoAB$interno'>".$directoAB.$interno."</option>
		  <option value ='$directoSS$interno'>".$directoSS.$interno."</option>
        </select>";
	}
	if ($ctro_trab == "ABASTO") {
	
	echo "<select name='telefono' id='telefono' class='box2' onchange='this.form.submit()'>
		  <option value ='$directoAB$interno'>".$directoAB.$interno."</option>
		  <option value ='$directoADE$interno'>".$directoADE.$interno."</option>
		  <option value ='$directoSF$interno'>".$directoSF.$interno."</option>
		  <option value ='$directoSS$interno'>".$directoSS.$interno."</option>
        </select>";
	}
	
	echo "</td><tr>
	<td class='textoform' align='right'>Area:</td>
	<td>
		<label>
		<select name='desc_costo' id='desc_costo' class='box2' onchange='this.form.submit()'>";
				
			if ($n_unidad_jefe <> NULL){
			
					if ($jefeoasist == '1'){
						echo "<option value ='$n_unidad_gcia'>".$n_unidad_gcia."</option>";
						echo "<option value ='$n_unidad_jefe'>".$n_unidad_jefe."</option>";
					}
					else {
						echo "<option value ='$n_unidad_jefe'>".$n_unidad_jefe."</option>";
						#echo "<option value ='$n_unidad_gcia'>".$n_unidad_gcia."</option>";
					}	
			}
			/*if (($n_unidad_gcia <> NULL) and ($n_unidad_gcia != $n_unidad_jefe)){					
				echo "<option value ='$n_unidad_gcia'>".$n_unidad_gcia."</option>";
			}*/
		
		else {
			
			if ($n_unidad_jefe <> NULL){
				echo "<option value ='$n_unidad_jefe'>".$n_unidad_jefe."</option>"; }
				
			if (($n_unidad_gcia <> NULL) and ($n_unidad_gcia != $n_unidad_jefe)){
				echo "<option value ='$n_unidad_gcia'>".$n_unidad_gcia."</option>"; }
				
			if (($desc_costo <> NULL) and ($desc_costo != $n_unidad_jefe)){
				echo "<option value ='$desc_costo'>".$desc_costo."</option>"; }
		}
		
		echo "</select>		
    </label>
	</td>
	<td width='10%' align='right' class='textoform'>Direcci�n:</td>
	<td width='44%'>";
	
	if (($ctro_trab == "MADRYNPRIM") or ($ctro_trab == "MADRYNSEMI")) {
	
	echo "<select name='direccion' id='direccion' class='box2' onchange='this.form.submit()'>
	      <option value ='$direccionPM'>".substr($direccionPM, 48,59)."...</option>
		  <option value ='$direccionSF'>".substr($direccionSF, 48,63)."...</option>
        </select>";
	}
	
	if (($ctro_trab == "SFERNAPRIM") and ($ctro_costo != 'AL10100020')) {
	
	echo "<select name='direccion' id='direccion' class='box2' onchange='this.form.submit()'>
	      <option value ='$direccionSF'>".substr($direccionSF, 48,63)."...</option>
		  <option value ='$direccionAB'>".substr($direccionAB, 48,66)."...</option>
		  <option value ='$direccionADE'>".substr($direccionADE, 48,66)."...</option>
		  <option value ='$direccionSS'>".substr($direccionSS, 48,72)."...</option>
        </select>";
	}
	if ($ctro_trab == "LUGANO") {
	
	echo "<select name='direccion' id='direccion' class='box2' onchange='this.form.submit()'>
	      <option value ='$direccionSF'>".substr($direccionSF, 42,63)."...</option>
		  <option value ='$direccionAB'>".substr($direccionAB, 42,66)."...</option>
		  <option value ='$direccionADE'>".substr($direccionADE, 42,66)."...</option>
		  <option value ='$direccionSS'>".substr($direccionSS, 42,72)."...</option>
        </select>";
	}
	if ($ctro_trab == "ABASTO") {
	
	echo "<select name='direccion' id='direccion' class='box2' onchange='this.form.submit()'>
	      <option value ='$direccionAB'>".substr($direccionAB, 42,66)."...</option>
		  <option value ='$direccionSF'>".substr($direccionSF, 42,63)."...</option>
		  <option value ='$direccionADE'>".substr($direccionADE, 42,66)."...</option>
		  <option value ='$direccionSS'>".substr($direccionSS, 42,72)."...</option>
        </select>";
	}
	
	if ($ctro_costo ==	'AL10100020') {		# Centro de costos de Sede Social - Marcelo T.
	
	echo "<select name='direccion' id='direccion' class='box2' onchange='this.form.submit()'>
	      <option value ='$direccionSS'>".substr($direccionSS, 42,72)."...</option>
		  <option value ='$direccionSF'>".substr($direccionSF, 42,63)."...</option>
		  <option value ='$direccionAB'>".substr($direccionAB, 42,66)."...</option>
		  <option value ='$direccionADE'>".substr($direccionADE, 42,66)."...</option>
		  
        </select>";
	}
	
	echo"</td>
	</tr>
	<tr>
	<td class='textoform' align='right'>Funci�n:</td>
	<td>
	<input name='tarea' type='text' class='box2' id='tarea' value='$tarea' size='41' onchange='this.form.submit()'>
	</td>
	<td></td>
	<td valign='middle'>";
	
	echo "</td>
	</tr>
	<td height='35' colspan='4' align='center'>
	
	<input type='hidden' name='showpreview' id='showpreview' value=TRUE>
	<input type='hidden' name='email' id='email' value='$email'>
	<input type='hidden' name='legajo' id='legajo' value='$legajo'>
	<input type='hidden' name='ctro_costo' id='ctro_costo' value='$ctro_costo'>	
	<input name='button' type='submit' class='boton' value='Vista Previa'>
    
	</td>
	</table>
	</form></fieldset><br>";
	
	# Frame de vista previa
	
	echo "<fieldset>
	<legend class='textonegrita'>Vista previa de la firma</legend>
	
	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='45%'><IFRAME name ='preview' src='preview.php' width='100%' height='310' frameborder='0' scrolling='no' id='preview'></IFRAME></td>
    <td width='55%'><IFRAME name ='info' src='ayuda.htm' width='100%' height='310' frameborder='0' scrolling='yes' id='preview'></IFRAME></td>
  </tr>
</table>
	
	</fielset>";
	
	OCIFreeStatement($sql_met4);
	@OCILogOff($sql_met4);
	
	}
	}
}

?>
