function validarCedula(){
	var cedulaPersona = $F('cedula');
	var tipo = $F('tipo');
	
	 if (!/^([0-9])*$/.test(cedulaPersona)){

			alert("El valor (" + cedulaPersona + ") no es un numero");
			return (false);			

	}
	else{
	$('mensajeVal').update("Cargando...");	
	new Ajax.Updater('mensajeVal','../php/validarPersona.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpTipo:tipo}})	
	}
}

function insertarEliminarConyugue(){
	
	var estadoCivil = $F('estado_civil');
	
	if (estadoCivil == 'Casado'){
		$('campoNombreConyugue').update('<td>Nombre de Conyugue:</td>');
		$('campoNombreConyugue1').update('<td><input type="text" name="nombre_conyugue" id="nombre_conyugue"></td>');
	}
	else{
		$('campoNombreConyugue').update("");
		$('campoNombreConyugue1').update("");
	}
}


function validarCamposHTML(form){
	
	var sexo = $F('sexo');
	var estadoCivil = $F('estado_civil');
	var beneficiario = $F('beneficiario');
	var nombre = $F('nombre');
	var apellido = $F('apellido');
	var cedula = $F('cedula');
	var direccion = $F('direccion');
	var fechaNacimiento = $F('fecha_nacimiento');
	var telefono =  $F('telefono');
	var fechaLicencia = $F('fecha_licencia');
	var nacionalidad = $F('nacionalidad');
	var monto = $F('monto');
	
	
	if (!nombre){
		alert("Debe ingresar el nombre");
		form.nombre.focus();
		return (false);
		
		
	}
	
	if (!apellido){
		alert("Debe ingresar el apellido");
		form.apellido.focus();
		return (false);
		
		
	}
	if (!cedula){
		alert("Debe ingresar la cedula");
		form.cedula.focus();
		return (false);
		
		
	}else if (!/^([0-9])*$/.test(cedula)){

			alert("El valor (" + cedula + ") no es un numero");
			form.cedula.focus();
			return (false);			

	}
	
	if (!direccion){
		alert("Debe ingresar la direccion");
		form.direccion.focus();
		return (false);
		
		
	}
	
	if (!fechaNacimiento){
		alert("Debe ingresar la fecha de nacimiento");
		form.fecha_nacimiento.focus();
		return (false);
		
		
	}
	if (!telefono){
		alert("Debe ingresar el telefono");
		form.telefono.focus();
		return (false);
		
		
	}else if (!/^([0-9])*$/.test(telefono)){

			alert("El valor (" + telefono + ") no es un numero");
			form.telefono.focus();
			return (false);			

	}
	
	if (!nacionalidad){
		alert("Debe ingresar la nacionalidad");
		form.nacionalidad.focus();
		return (false);
		
		
	}
	if (!fechaLicencia){
		alert("Debe ingresar la fecha en que obtuvo la licencia");
		form.fecha_licencia.focus();
		return (false);
		
		
	}
	
	if (sexo == '0'){
		alert("Debe seleccionar un sexo");
		form.sexo.focus();
		return (false);
	}
	
	if (estadoCivil == '0'){
		alert("Debe seleccionar un estado civil");
		form.estado_civil.focus();
		return (false);
		
	}
	
	if (estadoCivil == 'Casado'){
		var nombreConyugue = $F('nombre_conyugue');
		
		if (!nombreConyugue){
			alert("Debe igresar el nombre del conyugue");
			form.nombre_conyugue.focus();
			return (false);
		}
		
		
	}
	
	if (beneficiario == '0'){
		alert("Debe indicar si tiene beneficiario");
		form.beneficiario.focus();
		return (false);
	}
	
	
	if (!monto){
		
		alert("Debe indicar el monto de inscripcion");
		form.monto.focus();
		return (false);
		
	}else if (!/^([0-9])*$/.test(monto)){

			alert("El valor (" + monto + ") no es un numero");
			form.monto.focus();
			return (false);			

	}
	
	return (true);
}

function ValidarCamposBeneficiario(form){
	var flagBeneficiario = $F('flagBeneficiario');
	var cedulaPersona = $F('cedulaPersona');
	
	
	if (flagBeneficiario == '1'){
		alert("Existe uno o mas errores en el formulario");
		return (false);	
		
	}
	

	MM_goToURL('parent','../php/vehiculoSocio.php?id='+cedulaPersona+'');
}
	






function validarBeneficiario(){
	
	
	var cedulaBeneficiario = $F('cedula');
	var cedulaPersona = $F('cedulaPersona');
	
	
	
	alert (cedulaPersona);
	 if (cedulaBeneficiario){
	 	if (!/^([0-9])*$/.test(cedulaBeneficiario)){

			alert("El valor (" + cedulaBeneficiario + ") no es un numero");
			return (false);			

		}
		else{
			$('mensajeVal').update("Cargando...");	
			var tipo = 3;
			new Ajax.Updater('mensajeVal','../php/validarPersona.php',{method: 'post',parameters: {phpCedulaPersona:cedulaPersona, phpCedulaBeneficiario:cedulaBeneficiario, phpTipo:tipo}})
		
		
		}	
	 }
		
}
	
	
	
	
	
	
	
function validarPlaca(){
	
	var vehiculoPlaca = $F('placa');
	
	if (vehiculoPlaca){
		$('mensajeVal').update("Cargando...");
		new Ajax.Updater('mensajeVal','../php/validarPlaca.php',{method: 'post',parameters: {phpPlaca:vehiculoPlaca}})
	}
}


function VerificarInsertoVehiculo(){
	var cuentaVehiculo = $F('cuentaVehiculo');
	
	if (!cuentaVehiculo){
		alert ("Debe registrar al menos un vehiculo");
		return(false);
	}
	
	MM_goToURL('parent','../classes/Site.php');

	
}

function ValidarCamposVehiculo(form){
	
	
	
	var flagPlaca = $F('flagPlaca');
	
	
	if (flagPlaca == '1'){
		alert("Existe uno o mas errores en el formulario");
		return (false);		
		
	}
	
	
	
}