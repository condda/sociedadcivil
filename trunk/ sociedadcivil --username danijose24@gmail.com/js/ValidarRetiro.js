function llenarBeneficiario(){
	var cedulaPersona = $F('listaSoAv2');
	var tipo = $F('soAv');
	if (cedulaPersona != 0){
		var continuar = 1;
		new Ajax.Updater('listaB','../php/llenarBeneficiario.php',
						 {method: 'post',parameters: {phpcedulaPersona:cedulaPersona,phptipo:tipo}})
		new Ajax.Updater('botonContinuar','../php/llenarBeneficiario.php',
						 {method: 'post',parameters: {phpcontinuar:continuar}})
		$('nombre').update("Beneficiario");
		$('mensaje').update("Seleccione el/los beneficiarios luego haga click en verificar...");		
	}
	else{
		$('botonContinuar').update("");		
		$('mensaje').update("");		
		$('botonCrear').update("");		
		$('listaB').update("");
		$('nombre').update("");
	}
}

function anadirBoton(){
	
	var listaSoAv1 = $F('listaSoAv1');
	var razon = $F('razon');

	if ((listaSoAv1 != 0) && (razon != 0)){
		var activar=1;
		$('boton').update("Cargando...");	
		new Ajax.Updater('boton','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpactivar:activar,phprazon:razon,phplistaSoAv1:listaSoAv1}})	
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
		var activarCrear=1;
		$('boton').update("Cargando...");	
		new Ajax.Updater('boton','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpactivarCrear:activarCrear}})	
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

function validarCheckbox(){
	var cont = $F('cont');
	var monto = $F('monto');
	var form=new Array(cont);
	var sirve=0;
	var flag=0;
	var seleccionado = 0;
	var montoTotal=0;
	for (i=1;i<=cont;i=i+1)
	{
		if ($F('b'+i)){
			sirve=1;
			seleccionado++;
			form[i]=$F('b'+i);
		}
	}
	
	if(!sirve){
		montoTotal=monto;
		alert("Debe seleccionar al menos un beneficiario...");
		$('botonCrear').update("");		
		$('mensaje').update("Seleccione el/los beneficiarios luego haga click en verificar...");	
		flag=10;
		new Ajax.Updater('flagI','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpflag:flag,phpmontoTotal:montoTotal}})	

	}
	else{
		montoTotal=monto/seleccionado;
		$('mensaje').update("Se ha seleccionado el/los beneficiarios proceda a crear el retiro...");	
		var activarCrear=1;
		flag=11;
		new Ajax.Updater('botonCrear','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpactivarCrear:activarCrear}})	
		new Ajax.Updater('flagI','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpflag:flag,phpmontoTotal:montoTotal}})	
	}
}

function validarInscripcion(){
	var cedulaRetiro = $F('listaSoAv2');
	var tipo = $F('soAv');
	if(cedulaRetiro!=0){
		var activarCrear=1;		
		$('mensaje').update("");	
		$('montoRetiro').update("Cargando...");	
		new Ajax.Updater('montoRetiro','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpcedulaRetiro:cedulaRetiro,phptipo:tipo}})
	}
	else
	{
		$('mensaje').update("Seleccione la persona a retirar...");	
		$('montoRetiro').update("");	
	}
}

function llenarDatosRetiro(){
	var consultarCodigo = $F('consultarCodigo');
	if (!/^([0-9])*$/.test(consultarCodigo)){
		$('datos').update("");			
		alert("El valor (" + consultarCodigo + ") no es un numero");
		return (false);	
	}
	else{
		new Ajax.Updater('datos','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpconsultarCodigo:consultarCodigo}})
		$('datos').update("Cargando...");	
	}
}

function llenarDatosRetiro2(){
	var consultarCodigo2 = $F('consultarCodigo2');
	if (!/^([0-9])*$/.test(consultarCodigo2)){
		$('datos').update("");			
		alert("El valor (" + consultarCodigo2 + ") no es un numero");
		return (false);	
	}
	else{
		new Ajax.Updater('datos','../php/llenarBeneficiario.php',{method: 'post',parameters: {phpconsultarCodigo2:consultarCodigo2}})
		$('datos').update("Cargando...");	
	}
}

function anadirLink(){	
	var linkSoAv = $F('listaSoAv1');
	if (linkSoAv != 0){
		$('boton').update("Cargando...");	
		new Ajax.Updater('boton','../php/llenarBeneficiario.php',{method: 'post',parameters: {phplinkSoAv:linkSoAv}})	
		$('mensaje').update("");	
	}
	else{
		$('boton').update("");	
		$('mensaje').update("Seleccione el tipo de persona...");	
	}
}
