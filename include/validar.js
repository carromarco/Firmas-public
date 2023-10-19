function validar(){
    //valido el campo de texto
    if (document.vacaciones.dias_total.value.length == 0)
		{ 
       	alert("Debe ingresar el total de dias de vacaciones.") 
       	document.vacaciones.dias_total.focus() 
       	return false; 
    	}
	if (document.vacaciones.dias.value.length == 0)
		{ 
       	alert("Debe ingresar los dias solicitados.") 
       	document.vacaciones.dias.focus() 
       	return false; 
    	}
	if (document.vacaciones.fecha_ini.value.length == 0)
		{ 
       	alert("La fecha de inicio incorrecta.") 
       	document.vacaciones.fecha_ini.focus() 
       	return false; 
    	}
}
