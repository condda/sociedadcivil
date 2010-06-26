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


function agregarBotonTD(){
	var cedulaPersona = $F('listaSocio');	
	var cargoPersona = $F('listaCargo');	
	
	if ((cedulaPersona != 0)&&(cargoPersona != 0)){
		$('boton').update("Cargando...");
		$('boton').update('<input type="button" name="button" id="button" value="Finalizar" onclick="finalizarTD()"/>');
		
	}
	else
	$('boton').update("");
		
	
}

function finalizar(){
	var cedulaPersona = $F('listaSocio');	
	var cargoPersona = $F('listaCargo');	
	
	new Ajax.Updater('mensajeVal','../php/insertarJD.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpCargoPersona:cargoPersona}})	
}


function finalizarTD(){
	var cedulaPersona = $F('listaSocio');	
	var cargoPersona = $F('listaCargo');	
	
	new Ajax.Updater('mensajeVal','../php/insertarTD.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpCargoPersona:cargoPersona}})	
}




function consultarCargos(){
	var fechaI = $F('fechaI');	
	var fechaF = $F('fechaF');
	
	if ((fechaI)&&(fechaF)){
		
		new Ajax.Updater('listaCargos','../php/consultarCargos.php',{method: 'post',parameters: {phpFechaI:fechaI, phpFechaF:fechaF}})	
	}

}

function consultarCargosTD(){
	var fechaI = $F('fechaI');	
	var fechaF = $F('fechaF');
	
	if ((fechaI)&&(fechaF)){
		
		new Ajax.Updater('listaCargos','../php/consultarCargosTD.php',{method: 'post',parameters: {phpFechaI:fechaI, phpFechaF:fechaF}})	
	}

}





function eliminarHistCargo(idHistCargo){
	var flag = 1;
	new Ajax.Updater('mensajeVal','../php/EliminarHistCargo.php',{method: 'post',parameters: {phpIdHistCargo:idHistCargo, phpFlag:flag}})	
	
}

function eliminarHistCargoTD(idHistCargo){
	var flag = 1;
	new Ajax.Updater('mensajeVal','../php/EliminarHistCargoTD.php',{method: 'post',parameters: {phpIdHistCargo:idHistCargo, phpFlag:flag}})	
	
}





function finalizarCrearCargoJD(){
	var nombreCargo = $F('nombreCargo');
	
	var tipoCargo = $F('tipoCargo');
	
	if (!nombreCargo){
		
		alert('Debe introducir un nombre');
		form.montoCuota.focus();
	}else{
		
		if (tipoCargo == 1){
			var descripcionCargo = $F('descripcionCargo');
		new Ajax.Updater('mensajeVal','../php/crearCargoJDTD.php',{method: 'post',parameters: {phpNombreCargo:nombreCargo, phpDescripcionCargo:descripcionCargo, phpTipoCargo:tipoCargo}})	
		}
		if (tipoCargo == 2){
			
		new Ajax.Updater('mensajeVal','../php/crearCargoJDTD.php',{method: 'post',parameters: {phpNombreCargo:nombreCargo, phpTipoCargo:tipoCargo}})	
		}
		
	}	
	
	
}

function modificarCargoJD(idJuntadirectiva){
	flag = 1;
	new Ajax.Updater('mensajeVal','../php/cargarModCargoJDTD.php',{method: 'post',parameters: {phpIdJuntaDirectiva:idJuntadirectiva, phpFlag:flag}})	
	
}



function eliminarCargoJD(idJuntadirectiva){
	var flag = 2;
	new Ajax.Updater('mensajeVal','../php/modEliminarCargoJDTD.php',{method: 'post',parameters: {phpIdJuntaDirectiva:idJuntadirectiva, phpFlag:flag}})	
	
}



function modificarCargoTD(idTribunald){
	flag = 1;
	new Ajax.Updater('mensajeVal','../php/cargarModCargoJDTD.php',{method: 'post',parameters: {phpIdTribunald:idTribunald, phpFlag:flag}})	
	
}

function eliminarCargoTD(idTribunald){
	var flag = 2;
	new Ajax.Updater('mensajeVal','../php/modEliminarCargoJDTD.php',{method: 'post',parameters: {phpIdTribunald:idTribunald, phpFlag:flag}})	
	
}



function finalizarModJD(idJuntadirectiva,flag){
	var nombreCargo = $F('nombreCargo');
	var descripcionCargo = $F('descripcionCargo');	
	new Ajax.Updater('mensajeVal','../php/modEliminarCargoJDTD.php',{method: 'post',parameters: {phpIdJuntaDirectiva:idJuntadirectiva, phpFlag:flag,phpNombreCargo:nombreCargo, phpDescripcionCargo:descripcionCargo}})	
		
}




function finalizarModTD(idTribunald,flag){
	var nombreCargo = $F('nombreCargo');
	new Ajax.Updater('mensajeVal','../php/modEliminarCargoJDTD.php',{method: 'post',parameters: {phpIdTribunald:idTribunald, phpFlag:flag,phpNombreCargo:nombreCargo}})	
		
}