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
			new Ajax.Updater('contenidoDatos','../php/insertarCuota.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpMontoPago:montoPago,phpIdCuota:idCuota,phpIdNorma:idNorma}})	
		else
			new Ajax.Updater('contenidoDatos','../php/insertarCuota.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpMontoPago:montoPago,phpIdCuota:idCuota}})	
	
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






function consultaCuota(){
	var idCuota = $F('listaCuota');
	var tipoCuota= $F('tipoCuota');
	
	if ((idCuota!=0)&&(tipoCuota != 0)){
		$('detalleCuota').update("Cargando...");
		new Ajax.Updater('detalleCuota','../php/detalleCuota.php',{method: 'post',parameters: {phpTipoCuota:tipoCuota,phpIdCuota:idCuota}})	
	}
	else 
	$('detalleCuota').update("");
	
}


function llenarCuota(){
	var tipoCuota= $F('tipoCuota');
	
	if (tipoCuota != 0){
		$('listaCuotas').update("Cargando...");
		$('detalleCuota').update("");
		new Ajax.Updater('listaCuotas','../php/detalleCuota.php',{method: 'post',parameters: {phpTipoCuota:tipoCuota}})	
	}
	else{
	$('listaCuotas').update("");
	$('detalleCuota').update("");
	}
}




function modificarCuota(idCuota){
	
	if(idCuota != 0)
		new Ajax.Updater('detalleCuota','../php/modificarCuota.php',{method: 'post',parameters: {phpIdCuota:idCuota}})	
	else
	$('detalleCuota').update("");
	
	
}



function actualizarMonto(idCuota){
	
	var montoCuota = $F('montoCuota');
		
		if (!montoCuota){
		alert('Debe introducir un monto');
		form.montoCuota.focus();
		
		}
		else if (!/^([0-9])*$/.test(montoCuota)){

			alert("El valor (" + montoCuota + ") no es un número");
			form.montoCuota.focus();
			return (false);			

		}
		else{
			$('detalleCuota').update("Cargando...");
			new Ajax.Updater('detalleCuota','../php/modificarCuota.php',{method: 'post',parameters: {phpIdCuota:idCuota,phpFlag:1,phpMontoCuota:montoCuota}})	
		}
	
}







function buscarCuotasPersona(){
	var cedulaPersona = $F('cedulaPersona');
	var tipoCuota =  $F('tipoCuota');
	
	
	if (!cedulaPersona){
		$('listaCuotas').update("");
		alert('Debe introducir una cedula');
		
		
		
		}
		else if (!/^([0-9])*$/.test(cedulaPersona)){
			$('listaCuotas').update("");
			alert("El valor (" + cedulaPersona + ") no es un número");
			
			


		}
		else{
			if (tipoCuota != 0){
				$('listaCuotas').update("Cargando...");
				new Ajax.Updater('listaCuotas','../php/consultaCuota.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpTipoCuota:tipoCuota}})	
			}
			else
			$('listaCuotas').update("");
		}
	
	
}





function consultarCuotaTodos(){
	var tipoCuota =  $F('tipoCuota');
	var fechaI =  $F('fechaI');	
	var fechaF =  $F('fechaF');
	
	if ((tipoCuota != 0) &&(fechaI) && (fechaF)){
		$('listaCuotas').update("Cargando...");
	new Ajax.Updater('listaCuotas','../php/consultaCuotaTodos.php',{method: 'post',parameters: {phpTipoCuota:tipoCuota,phpFechaI:fechaI,phpFechaF:fechaF}})	
	}
	else
	$('listaCuotas').update("");
	
	
}