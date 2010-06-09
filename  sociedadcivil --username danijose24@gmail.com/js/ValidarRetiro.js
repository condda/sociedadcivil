function llenarBeneficiario(){
	var cedulaPersona = $F('listaSoAv2');
	var tipo = $F('soAv');
	if (cedulaPersona != 0){
		new Ajax.Updater('listaB','../php/llenarBeneficiario.php',
						 {method: 'post',parameters: {phpcedulaPersona:cedulaPersona,phptipo:tipo}})
		$('nombre').update("Beneficiario");
	}
	else{
		$('listaB').update("");
		$('nombre').update("");
	}
}

function anadirBoton(){
	
	var listaSoAv1 = $F('listaSoAv1');
	var razon = $F('razon');

	if ((listaSoAv1 != 0) && (razon != 0)){
		var activar=1;
		new Ajax.Updater('boton','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpactivar:activar}})	
		$('mensaje').update("");	
	}
	else if (listaSoAv1 != 0){
		$('boton').update("");	
		$('mensaje').update("Seleccione la razon del retiro...");	
	}
	else if (razon != 0){
		$('mensaje').update("Seleccione el tipo de persona que se va a retirar...");	
		$('boton').update("");	
	}
	else{
		$('boton').update("");	
		$('mensaje').update("Seleccione la razon del retiro y el tipo de persona que se va a retirar...");	
	}
}


function anadirBotonB(){
	
	var listaSoAv1 = $F('listaSoAv1');

	if (listaSoAv1 != 0){
		var activar=1;
		new Ajax.Updater('boton','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpactivar:activar}})	
		$('mensaje').update("");	
	}
	else{
		$('boton').update("");	
		$('mensaje').update("Seleccione con que tipo de persona es el parentezco...");	
	}
}

function validarLista(){
	var lista = $F('listaSoAv2');
	if (lista == 0)
		$('mensaje').update("Seleccione la persona de la que usted es pariente...");
	else
		$('mensaje').update("Continue introduciendo los datos del beneficiario...");	
}

function validarCedula(){
	var cedulaB = $F('cedula');
	var nombre = $F('nombre');
	var apellido = $F('apellido');
	var activarB=1;
	var lista = $F('listaSoAv2');
	
	if (!/^([0-9])*$/.test(cedulaB)){
			alert("El valor (" + cedulaB + ") no es un numero");
			return (false);			
	}
	else if ((lista!=0) && (nombre!="") && (apellido!="")){
		$('mensaje').update("Cargando...");	
		new Ajax.Updater('mensaje','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpcedulaB:cedulaB}})	
	}
}