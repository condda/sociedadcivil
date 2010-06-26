function consultarPersona(){
	var cedulaPersona = $F('cedulaPersona');
	var tipoPersona = $F('tipoPersona');
	if ((cedulaPersona)&&(tipoPersona!=0)){
	
	$('detallePersona').update("Cargando...");
	new Ajax.Updater('detallePersona','../php/consultarPersona.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona,phpTipoPersona:tipoPersona}})	
	agregarBoton();

	
	}
	else{
	$('detallePersona').update("");
	$('boton').update("");
	}
	
}

function agregarBoton(){
	var cedulaPersona = $F('cedulaPersona');
	var idNorma =  $F('listaNorma');
	var idTribunald =  $F('listaTribunal');
	var tipoPersona =  $F('tipoPersona');
	var flag = $F('flag');
	
	
	if ((cedulaPersona) && (idNorma != 0)&&(idTribunald != 0) && (tipoPersona != 0)&&(flag == 1)){
		

		$('boton').update('<input type="button" name="button" id="button" value="Finalizar" onclick="insertarSancion()"/>');
	}
	else{
		
		$('boton').update("");
	}
	
	
}

function insertarSancion(){
	var cedulaPersona = $F('cedulaPersona');
	var idNorma =  $F('listaNorma');
	var tipoPersona = $F('tipoPersona');
	var idTribunald =  $F('listaTribunal');
	
	new Ajax.Updater('mensajeVal','../php/insertarSancion.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona,phpTipoPersona:tipoPersona,phpIdNorma:idNorma,phpTribunald:idTribunald}})	
	
}


function consultaSancion(){
	var tipoPersona = $F('tipoPersona');
	var cedulaPersona = $F('cedulaPersona');
	
	if ((tipoPersona != 0) && (cedulaPersona)){
		$('listaSancion').update("Cargando...");
		
		new Ajax.Updater('listaSancion','../php/consultaSancion.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona,phpTipoPersona:tipoPersona}})	
		
	}
	else
		$('listaSancion').update("");
	
}