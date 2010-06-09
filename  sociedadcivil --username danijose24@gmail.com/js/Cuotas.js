function buscarPersona(){
	var cedulaPersona = $F('cedulaPersona');
	var personaSocio = $F('tipoPersona_0');
	var personaAvance = $F('tipoPersona_1');
	var tipoCuota = $F('tipoCuota');
	if (cedulaPersona){
		
		if  ((personaSocio == 1) && (tipoCuota != 0)){
			$('infoPersona').update("Cargando...");
			new Ajax.Updater('infoPersona','../php/CuotasPersona.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona,phpTipoPersona:personaSocio,phpTipoCuota:tipoCuota}})	
		}
		
		if  ((personaAvance == 2) && (tipoCuota != 0)){
			
			$('infoPersona').update("Cargando...");
			new Ajax.Updater('infoPersona','../php/CuotasPersona.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona,phpTipoPersona:personaAvance,phpTipoCuota:tipoCuota}})	
					
	
		}
	}
	else
		$('infoPersona').update("");
	
	
}



function datosCuota(){
	var	cedulaPersona = $F('cedulaPersona');
	var tipoCuota = $F('tipoCuota');
	if (cedulaPersona)
	new Ajax.Updater('contenidoDatos','../php/datosCuota.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona,phpTipoCuota:tipoCuota}})	
	
}





function insertarCuota(){
	var cedulaPersona = $F('cedulaPOculto');
	var	montoPago = $F('montoPago');
	
	var idCuota = $F('idCuota');
	var idNorma = $F('idNorma1');
	if (montoPago){ 
		$('mensajeVal').update("Cargando...");
		if (idNorma != 0)
			new Ajax.Updater('mensajeVal','../php/insertarCuota.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpMontoPago:montoPago,phpIdCuota:idCuota,phpIdNorma:idNorma}})	
		else
			new Ajax.Updater('mensajeVal','../php/insertarCuota.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpMontoPago:montoPago,phpIdCuota:idCuota}})	
			
  	$('mensajeVal').update("");
	$('contenidoDatos').update("Se ha registrado su pago con existo.");
	
	}
	else
	$('mensajeVal').update("");
	
	
}





function funcionTipoCuota(){
	var tipoCuota = $F('tipoCuota');
	if (tipoCuota != 0){
		buscarPersona();
				
	}
	else
	$('infoPersona').update("");
	
}



function montoMesCuota(){
	var idCuota = $F('MesCuota');
	var tipoCuota = $F('tipoCuota');
	var cedulaPersona = $F('cedulaPOculto');
	
	
	if (idCuota != 0){
	
		$('mensajeVal').update("Cargando...");
		new Ajax.Updater('mensajeVal','../php/calcularCuota.php',{method: 'post',parameters: {phpIdCuota:idCuota, phpTipoCuota:tipoCuota,phpCedulaPersona:cedulaPersona}})	
		
		
	}
	else
	$('mensajeVal').update("");
	
}
