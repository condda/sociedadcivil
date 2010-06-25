function agregarBoton(){
	var cedulaPersona = $F('listaSocio');	
	var cargoPersona = $F('listaCargo');	
	
	if ((cedulaPersona != 0)&&(cargoPersona != 0)){
		$('boton').update("Cargando...");
		$('boton').update('<input type="button" name="button" id="button" value="Finalizar" onclick="finalizar()"/>');
		
	}
	else
	$('boton').update("");
		
	
}

function finalizar(){
	var cedulaPersona = $F('listaSocio');	
	var cargoPersona = $F('listaCargo');	
	
	new Ajax.Updater('mensajeVal','../php/insertarJD.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpCargoPersona:cargoPersona}})	
}




function consultarCargos(){
	var fechaI = $F('fechaI');	
	var fechaF = $F('fechaF');
	
	if ((fechaI)&&(fechaF)){
		
		new Ajax.Updater('listaCargos','../php/consultarCargos.php',{method: 'post',parameters: {phpFechaI:fechaI, phpFechaF:fechaF}})	
	}

}





function eliminarHistCargo(idHistCargo){
	var flag = 1;
	new Ajax.Updater('mensajeVal','../php/EliminarHistCargo.php',{method: 'post',parameters: {phpIdHistCargo:idHistCargo, phpFlag:flag}})	
	
}
