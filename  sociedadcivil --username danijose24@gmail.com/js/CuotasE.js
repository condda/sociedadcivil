function CampoCedula(){
	var fondo = $F('fondo');
	
	if (fondo != 0){
		$('campoDatos').update('Cedula Persona&nbsp;&nbsp;&nbsp;&nbsp; <label><input type="text" name="cedulaPersona" id="cedulaPersona" onchange="datosCuota()" /></label>');
		$('mensajeVal').update("");
	}
	else{
		$('campoDatos').update("");
		$('mensajeVal').update("");
	}
	
}




function datosCuota(){
	var fondo = $F('fondo');
	var cedulaPersona = $F('cedulaPersona');
	if (cedulaPersona){
		$('mensajeVal').update("Cargando...");
		new Ajax.Updater('mensajeVal','../php/CuotasEPersona.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpfondo:fondo}})	
	}
	else{
		$('mensajeVal').update("");
	}
	

}



function datosCuotaE(){
	var tipoPersona = $F('tipoPersona');
	var cedulaPersona = $F('cedulaPersona');

	if (cedulaPersona)
	new Ajax.Updater('mensajeVal','../php/datosCuotaE.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phptipoPersona:tipoPersona}})
	
}





function colocarBoton(){
	var	montoPago = $F('montoPago');
	var cedulaPOculto = $F('cedulaPOculto');
	var tipoPersona = $F('tipoPersona');
	if (montoPago)
	$('mensajeVal1').update('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="Finalizar" align="middle" onclick="insertarCuotaE()" /><input type="hidden" name="cedulaPOculto" id="cedulaPOculto" value="'+cedulaPOculto+'"/><input type="hidden" name="tipoPersona" id="tipoPersona" value="'+tipoPersona+'"/>');
	else
	$('mensajeVal1').update("");
}





function insertarCuotaE(){
	var cedulaPersona = $F('cedulaPOculto');
	var	montoPago = $F('montoPago');
	var tipoPersona = $F('tipoPersona');
	
	if (montoPago){
		$('contenidoDatos').update("");
		new Ajax.Updater('mensajeVal1','../php/insertarCuotaE.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpMontoPago:montoPago,phptipoPersona:tipoPersona}})	
	}
	else
	$('mensajeVal1').update("");
	
	
}