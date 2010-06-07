function buscarPersona(){
	var cedulaPersona = $F('cedulaPersona');
	var personaSocio = $F('tipoPersona_0');
	var personaAvance = $F('tipoPersona_1');
	
	if (cedulaPersona){
		
		if  (personaSocio == 1){
			$('infoPersona').update("Cargando...");
			new Ajax.Updater('infoPersona','../php/CuotasPersona.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona,phpTipoPersona:personaSocio}})	
		}
		
		if  (personaAvance == 2){
			
			$('infoPersona').update("Cargando...");
			new Ajax.Updater('infoPersona','../php/CuotasPersona.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona,phpTipoPersona:personaAvance}})	
					
	
		}
	}
	else
		$('infoPersona').update("");
	
	
}



function datosCuota(){
	var	cedulaPersona = $F('cedulaPersona');
	
	if (cedulaPersona)
	new Ajax.Updater('contenidoDatos','../php/datosCuota.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona}})	
	
}

function colocarBoton(){
	var	montoPago = $F('montoPago');
	var cedulaPOculto = $F('cedulaPOculto');
	if (montoPago)
	$('mensajeVal').update('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="Finalizar" align="middle" onclick="insertarCuota()" /><input type="hidden" name="cedulaPOculto" id="cedulaPOculto" value="'+cedulaPOculto+'"/>');
	else
	$('mensajeVal').update("");
}



function insertarCuota(){
	var cedulaPersona = $F('cedulaPOculto');
	var	montoPago = $F('montoPago');
	
	if (montoPago){
		$('contenidoDatos').update("");
		new Ajax.Updater('mensajeVal','../php/insertarCuota.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpMontoPago:montoPago}})	
	}
	else
	$('mensajeVal').update("");
	
	
}