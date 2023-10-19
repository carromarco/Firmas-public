<!DOCTYPE html>
<head>
<link href="css/personal.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php

include ("include/inc.define.php");

if ($_POST['Comprobar'] == 'si')
{
$dato_nu = trim ($_POST['legajo']);

	if (!is_numeric($dato_nu))
		{
		echo "<fieldset><legend class='textonegrita'>Error&nbsp;&nbsp;</legend>
		<span class='textoerror'><center>El legajo ingresado debe ser numérico, no puede incluir letras.</center></span>
		</fieldset>";
		}
	else {
			
	$conn = oci_connect($usuario, $clave, $db10);
							
	$sql_met4 = OCIParse($conn,"select to_number(U.L_EMPLEADO_ALU) as LEGAJO, initcap (u.x_nombre) as NOMBRES, initcap (u.x_apellido) as APELLIDO, initcap (u.x_uo ) as DESC_COSTO,       -- initcap (u.x_unidad) as DESC_COSTO,  
       u.c_div_empresa   as CTRO_TRAB, initcap( u.x_posicion ) as TAREA, initcap (u.x_uo) as N_UNIDAD, initcap(O.X_UO) as UNIDAD_JEFE,
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
		echo "<fieldset><legend class='textonegrita'>Error&nbsp;&nbsp;</legend>
		<span class='textoerror'><center>El legajo ingresado es incorrecto.<br><br>Esto puede deberse a que ingresó un legajo inexistente o la cuenta asociada a ese legajo no esta dentro del grupo de usuarios autorizados.<br><br></center></span>
		</fieldset>";
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
		$tarea = str_replace("Distribuc.", "Distribución", $tarea);
		$tarea = str_replace("1° Cat.", "", $tarea);
		$tarea = str_replace("2° Cat.", "", $tarea);
		
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
		$tarea = str_replace("Medico", "Médico", $tarea);
		$tarea = str_replace("Serv Auxil", "Serv. Auxiliares", $tarea);
		$tarea = str_replace("Industr.", "Industrial", $tarea);
		$tarea = str_replace("Lider", "Líder", $tarea);
		$tarea = str_replace("Electrico", "Eléctrico", $tarea);
		$tarea = str_replace("Mecanico", "Mecánico", $tarea);
		$tarea = str_replace("Tecnico", "Técnico", $tarea);
		$tarea = str_replace("Redes", "Telecomunicaciones", $tarea);
		$tarea = str_replace("Ingeniero En Telecomunicaciones", "Analista en Telecomunicaciones", $tarea);					
		$tarea = str_replace("Compens.", "Compensaciones", $tarea);
		$tarea = str_replace("Rrhh", "Recursos Humanos", $tarea);
		$tarea = str_replace("Rrii", "Relaciones Industriales", $tarea);
		
		$tarea = str_replace("Code", "Conversión Eléctrica", $tarea);
		$tarea = str_replace("Geel", "Generación Eléctrica", $tarea);
		$tarea = str_replace("Caii", "Control de Calidad", $tarea);
		$tarea = str_replace("- Sistemas -", "de Sistemas", $tarea);
		$tarea = str_replace("Facturacion", "Facturación", $tarea);
		$tarea = str_replace("Informacion ", "Información ", $tarea);
		$tarea = str_replace("Ingenieria", "Ingeniería", $tarea);
		$tarea = str_replace("Gestion", "Gestión", $tarea);
		$tarea = str_replace("Credito", "Crédito", $tarea);
		$tarea = str_replace("Logistica", "Logística", $tarea);
		
		$tarea = str_replace("Produccion", "Producción", $tarea);
		$tarea = str_replace("Expedicion", "Expedición", $tarea);
		$tarea = str_replace("Recepcion", "Recepción", $tarea);
		$tarea = str_replace("Economico", "Económico", $tarea);
		$tarea = str_replace("Extrusion", "Extrusión", $tarea);
		$tarea = str_replace("Reduccion", "Reducción", $tarea);
		$tarea = str_replace("Energia", " Energía", $tarea);
				
		$tarea = str_replace("Administracion", "Administración", $tarea);
		$tarea = str_replace("Planificacion", "Planificación", $tarea);
				
		$tarea = str_replace("Tecnologia", "Tecnología", $tarea);
		$tarea = str_replace("Informatica", "Informática", $tarea);
		
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
		$tarea = str_replace("CoordinadorCapacitación", "Coordinador de Capacitación", $tarea);
		$tarea = str_replace("CoordinadorGmp Manten. Electr./Electronico", "Coordinador de Mantenimiento Eléctrico", $tarea);
		$tarea = str_replace("Telecomunicaciones, Proyectos e Infr.Telecom", "Telecomunicaciones", $tarea);
		$tarea = str_replace("Juridicos", "Jurídicos", $tarea);
		$tarea = str_replace("Almacen ", "Almacén ", $tarea);
		$tarea = str_replace("Fundicion", "Fundición", $tarea);
		
		if ($legajo == '23293'){ $tarea = "Analista en Telecomunicaciones"; }
		if ($legajo == '22358'){ $tarea = "Analista de Tecnología Informática"; }
			
		
		$isjefe = strpos($c_puesto,'JEF');

		if($isjefe !== FALSE){
    		$jefeoasist = '1';
			}
			else {
			$jefeoasist = '0'; 
			}
			
				
		$directoPM = "Tel: +54 280 445-9000";
		$direccionPM = "<br>ALUAR ALUMINIO ARGENTINO S.A.I.C.<br>
					Parque Industrial Pesado • U9120OIA<br>
					Puerto Madryn • Chubut • Argentina";
			
		$directoSF = "Tel: +54 11 4725-8000";
		$direccionSF = "<br>ALUAR ALUMINIO ARGENTINO S.A.I.C.<br>
					Pasteur 4600 • B1644AMV<br>
					Victoria • Buenos Aires • Argentina";
		
		$directoAB = "Tel: +54 11 4725-8000";
		$direccionAB = "<br>ALUAR ALUMINIO ARGENTINO S.A.I.C.<br>
					DIVISION ELABORADOS<BR>
					Ruta Prov. 2 Km. 54 • B1933BWA<br>
					Abasto • Buenos Aires • Argentina";
		
		$directoADE = "Tel: +54 11 4725-8000";
		$direccionADE = "<br>ALUAR ALUMINIO ARGENTINO S.A.I.C.<br>
					DIVISION ELABORADOS<BR>
					Pasteur 4600 • B1644AMV<br>
					Victoria • Buenos Aires • Argentina";
		
		$directoSS = "Tel: +54 11 4311-8911";
		$direccionSS = "<br>ALUAR ALUMINIO ARGENTINO S.A.I.C.<br>
					SEDE SOCIAL<BR>
					Marcelo T. de Alvear 590, 3° Piso • C1058AAF<br>
					Capital Federal • Buenos Aires • Argentina";

		if ($interno !=""){ $interno = " - Ext. ".$interno; }
				
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
		$n_unidad_jefe = str_replace("Direccion", "Dirección", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Indust.", "Industrial", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Energia", " Energía", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Distribución Energía", "Distribución de Energía", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Generación Energía", "Generación de Energía", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Gerencia Investigación", "Gerencia de Investigación", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Semielaborados 1", "Semielaborados", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Semielaborados 2", "Semielaborados II", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Sistemas Puerto Madryn", "de Sistemas", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Administracion", "Administración", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Procedimiento", "Procedimientos", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Coordinacion", "Coordinación", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Planificacion", "Planificación", $n_unidad_jefe);
		
		$n_unidad_jefe = str_replace("Serv.", "Servicios", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Proteccion ", "Protección ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Mantenim ", "Mantenimiento ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Mantenim.", "Mantenimiento", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Gestion", "Gestión", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Credito", "Crédito", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Tecnic", "Técnic", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Economico", "Económico", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Extrusion", "Extrusión", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Atencion", "Atención", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Proc. de Reduccion", "Procesos de Reducción", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Rrhh", "RRHH", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Depto ", "Dpto. ", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Logistica", "Logística", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Electrico", "Eléctrico", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Electronico", "Electrónico", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Tecnologia", "Tecnología", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Informatica", "Informática", $n_unidad_jefe);
		$n_unidad_jefe = str_replace("Juridico", "Jurídico", $n_unidad_jefe);
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
		$n_unidad_gcia = str_replace("Á", "A", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Analistas Sf", "Aplicaciones Comerciales y Logísticas", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Gerencia Investigación", "Gerencia de Investigación", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Gerencia Planeamiento", "Gerencia de Planeamiento", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Planificacion", "Planificación", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Extrusion", "Extrusión", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Tecnic", "Técnic", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Tecnologia ", "Tecnología ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Informatica", "Informática", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Informacion ", "Información ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Direccion ", "Dirección ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Gestion", "Gestión", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Facturacion ", "Facturación ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Mantenim.", "Mantenimiento", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Energeticos", "Energéticos", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Redes", "Proyectos e Infraestructura de Telecomunicaciones", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Redes, Proy. e Infraestruct. de Telecom.", "Proyectos e Infraestructura de Telecomunicaciones", $n_unidad_gcia);
		
		$n_unidad_gcia = str_replace("Administracion ", "Administración ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Desarr. de Prod.", "Desarrollo de Producto", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Serv. Comp. de Administ.", "Serv. Compartidos de Admin. del", $n_unidad_gcia);	
		$n_unidad_gcia = str_replace("Energia", "Energía", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Depto ", "Dpto. ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Depto ", "Dpto. ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Gcia ", "Gcia. ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Rrhh", "RRHH", $n_unidad_gcia);
				
		$n_unidad_gcia = str_replace("Administracion ", "Administración ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Desarr. de Prod.", "Desarrollo de Producto", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Serv. Comp. de Administ.", "Serv. Compartidos de Admin. del", $n_unidad_gcia);
				
		$n_unidad_gcia = str_replace("Energia", "Energía", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Depto ", "Dpto. ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Gcia ", "Gcia. ", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Rrhh", "RRHH", $n_unidad_gcia);
		$n_unidad_gcia = str_replace("Juridico", "Jurídico", $n_unidad_gcia);
				
		
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
		$desc_costo = str_replace("Coordinacion", "Coordinación", $desc_costo);
		$desc_costo = str_replace("Direccion", "Dirección", $desc_costo);
		$desc_costo = str_replace("Planeam ", "Planeamiento ", $desc_costo);
				
		$desc_costo = str_replace("Rr.Hh", "RRHH", $desc_costo);
		$desc_costo = str_replace("Rrhh", "RRHH", $desc_costo);
		$desc_costo = str_replace("( Pmo )", "PMO", $desc_costo);
		$desc_costo = str_replace("Ade", "ADE", $desc_costo);
		$desc_costo = str_replace("ADE I", "ADE", $desc_costo);
		$desc_costo = str_replace("Redes", "Proyectos e Infraestructura de Telecomunicaciones", $desc_costo);
		$desc_costo = str_replace("Redes, Proy. e Infraestruct. de Telecom.", "Proyectos e Infraestructura de Telecomunicaciones", $desc_costo);
			
		 
		$desc_costo = str_replace("Gcia.De", "Gcia. de", $desc_costo);
		$desc_costo = str_replace("Lider de Tecnología", "Tecnología Informática", $desc_costo);
		$desc_costo = str_replace("Extrusion", "Extrusión", $desc_costo);
		$desc_costo = str_replace("Fundicion", "Fundición", $desc_costo);
		$desc_costo = str_replace("Laminacion", "Laminación", $desc_costo);
		$desc_costo = str_replace("Capacitacion", "Capacitación", $desc_costo);
		$desc_costo = str_replace("Programacion", "Programación", $desc_costo);
		$desc_costo = str_replace("Planificacion", "Planificación", $desc_costo);
		$desc_costo = str_replace("Administracion", "Administración", $desc_costo);
		$desc_costo = str_replace("Energia", "Energía", $desc_costo);
		$desc_costo = str_replace("Energetico", "Energético", $desc_costo);
		
		$desc_costo = str_replace("Mantenim ", "Mantenimiento ", $desc_costo);
		$desc_costo = str_replace("Gestion", "Gestión", $desc_costo);
		$desc_costo = str_replace("Tecnic", "Técnic", $desc_costo);
		$desc_costo = str_replace("Economico", "Económico", $desc_costo);
		$desc_costo = str_replace("Atencion", "Atención", $desc_costo);
		$desc_costo = str_replace("Mecanico", "Mecánico", $desc_costo);
		
		$desc_costo = str_replace("Analistas Sf", "Aplicaciones Planta San Fernando", $desc_costo);
		$desc_costo = str_replace("Tecnologia ", "Tecnología ", $desc_costo);
		$desc_costo = str_replace("Informatica", "Informática", $desc_costo);
		$desc_costo = str_replace("Facturacion", "Facturación", $desc_costo);
		$desc_costo = str_replace("Juridico", "Jurídico", $desc_costo);
		$n_unidad_gcia = str_replace("Logistica", "Logística", $n_unidad_gcia);
		
		if (strlen($desc_costo) < 35){
		$desc_costo = str_replace("Dpto.", "Departamento", $desc_costo); 	}
		
		if (strlen($desc_costo) > 35){
		$desc_costo = str_replace("Gerencia", "Gcia.", $desc_costo);
		$desc_costo = str_replace("Departamento","Dpto.", $desc_costo);	}
								
	
	echo "<fieldset style='width:97%;'>
	<legend class='textonegrita' >Datos del solicitante:&nbsp;&nbsp;</legend>
	<form name='firma' action='preview.php' method='POST' target='preview'>
	
	<table width='100%' border='0' cellpadding='2' cellspacing='3'><tr>
	<td width='8%' class='textoform' align='right'>Nombre:</td>
	<td>";
	
	/*echo "<select name='titulo' size='1' class='box2' id='titulo' onchange='this.form.submit()'>
	<option value='--' selected>--</option>
	<option value='Arq.'>Arq.</option>
	<option value='Cdr.'>Cdr.</option>
	<option value='Cdra.'>Cdra.</option>
	<option value='Dr.'>Dr.</option>
	<option value='Dra.'>Dra.</option>
	<option value='Ing.'>Ing.</option>
	<option value='Lic.'>Lic.</option>
	</select>";*/
	
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
	<td width='10%' align='right' class='textoform'>Dirección:</td>
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
	<td class='textoform' align='right'>Función:</td>
	<td>
	<input name='tarea' type='text' class='box2' id='tarea' value='$tarea' size='41' onchange='this.form.submit()'>
	</td>
	<td></td>
	<td valign='middle'>";
	
	/*<select name='logo' id='logo' class='box2' onchange='this.form.submit()'>
	      <option value ='1'>Aluar Aluminio Argentino</option>
		  <option value ='2'>Aluar División Elaborados</option>
        </select>*/
	
	echo "</td>
	</tr>
	<td height='35' colspan='4' align='center'>
	
	<input type='hidden' name='preview' id='preview' value='1'>
	<input type='hidden' name='email' id='email' value='$email'>
	<input type='hidden' name='legajo' id='legajo' value='$legajo'>
	<input type='hidden' name='ctro_costo' id='ctro_costo' value='$ctro_costo'>	
	<input name='button' type='submit' class='boton' value='Vista Previa'>
    </td>
	</table>
	</form></fieldset>";
	
	$vista_previa = "<fieldset>
	<legend class='textonegrita'>Vista previa de la firma:&nbsp;&nbsp;</legend>
	<IFRAME name ='preview' src='preview.php' width='100%' height='248' frameborder='0' scrolling='no' id='preview'></IFRAME>
	</fielset>";

	echo "<br>".$vista_previa;
		
	OCIFreeStatement($sql_met4);
	@OCILogOff($sql_met4);
	
	}
	}
}

?>

</body>
</html>
