function ValidarCodigoProducto(){
	
	var codigoProducto = $F('codigo');
	$('mensajeVal').update("Cargando...");
	new Ajax.Updater('mensajeVal','../php/validarProducto.php',{method: 'post',parameters: {phpproductoCodigo:codigoProducto, phpref:'producto'}})
			
			
		
	
}
function InsertarRemoverProveedor(){
	
	//var codigoProducto = $F('codigo');
	if($F('flagProveedor') == '0'){
	$('flagProv').update('<input name="flagProveedor" type="hidden" id="flagProveedor" value="1" />');
	$('proveedor').update('<h1>Proveedor</h1>');	
	new Ajax.Updater('insertarproveedor','../php/insertarProveedor.php',{method: 'post'})
	$('accionProveedor').update('<td width="146" style="color:#6F0" ><a href="#" onclick="InsertarRemoverProveedor()">Quitar Proveedor</a></td>');	
	}
	else{
		$('proveedor').update("");	
		$('flagProv').update('<input name="flagProveedor" type="hidden" id="flagProveedor" value="0" />');
		$('accionProveedor').update('<td width="146" style="color:#6F0" ><a href="#" onclick="InsertarRemoverProveedor()">Crear Proveedor</a></td>');	
		$('insertarproveedor').update("");	
		
		
	}
	
}

function ValidarCampos(form){

	var nombreProducto = $F('nombre');
	var descripcionProducto = $F('descripcion');
	var cantidadProducto = $F('cantidad');
	var precioProducto = $F('precio');
	
	var flagProveedor = $F('flagProveedor');
	
	
	
	if (!nombreProducto){
		
		alert('Debe introducir el nombre del Producto');
		form.nombre.focus();
		return (false);
		
	}
	if (!descripcionProducto){
		alert('Debe introducir la descripcion del Producto');
		form.descripcion.focus();
		return (false);
	}
	
		if (!precioProducto){
		alert('Debe introducir el precio del Producto');
		form.precio.focus();
		return (false);
	}
	else if (!/^([0-9])*$/.test(precioProducto)){

			alert("El valor (" + precioProducto + ") no es un número");
			form.precio.focus();
			return (false);			

		}
		


	if (!cantidadProducto){
		alert('Debe introducir la cantidad del Producto');
		form.cantidad.focus();
		return (false);
	}
	else if (!/^([0-9])*$/.test(cantidadProducto)){

			alert("El valor (" + cantidadProducto + ") no es un número");
			form.cantidad.focus();
			return (false);			

	}
	
	
 	if (flagProveedor == '1'){
		
		var selectrifCi = $F('ciRif')
		var cedRifProveedor = $F('cedRif');
		var nombreProveedor = $F('nombreProveedor');
		var direccionProvedor = $F('direccion');
		var telefonoProveedor = $F('telefono');
		
	
	if (selectrifCi == '0'){
		
		alert('Debe seleccionar el tipo de proveedor');
		form.ciRif.focus();
		return (false);
		
	}
	
	if (!cedRifProveedor){
		
		alert('Debe introducir la cedula o el rif');
		form.cedRif.focus();
		return (false);
		
	}
	if (!/^([0-9])*$/.test(cedRifProveedor)){

			alert("El valor (" + cedRifProveedor + ") no es un número");
			form.cedRif.focus();
			return (false);			

		}
	
	if (!nombreProveedor){
		
		alert('Debe introducir el nombre del Proveedor');
		form.nombreProveedor.focus();
		return (false);
		
	}
	if (!direccionProvedor){
		alert('Debe introducir la direccion del Proveedor');
		form.direccion.focus();
		return (false);
	}
	
	if (!telefonoProveedor){
		alert('Debe introducir un telefono');
		form.telefono.focus();
		return (false);
	}
	
	if (telefonoProveedor){
		
		if (!/^([0-9])*$/.test(telefonoProveedor)){

			alert("El valor (" + telefonoProveedor + ") no es un número");
			form.telefono.focus();
			return (false);			

		}
	}
		
		
		
	}
	
	
return (true);
}


function actualizarProveedor(flag){
	var seleectProv = $F('selectProveedor');
	var nombreProv =  $F('flagProveedor');
	
	if ((seleectProv) && (nombreProv)){
		
		if (flag == '1'){
			
			$('proveedor').update("");	
		$('flagProv').update('<input name="flagProveedor" type="hidden" id="flagProveedor" value="0" />');
		$('accionProveedor').update('<td width="146" style="color:#6F0" ><a href="#" onclick="InsertarRemoverProveedor()">Crear Proveedor</a></td>');	
		$('insertarproveedor').update("");	
		$('mensajeVal').update("");	
			
			
		}
		else if (flag == '2'){
			var CiRifProv = $F('cedRif');
			var selectCiRif = $F('ciRif');
			new Ajax.Updater('listaProveedor','../php/llenarListaProveedor.php',{method: 'post'})
			
			new Ajax.Updater('mensajeVal','../php/validarProveedor.php',{method: 'post', parameters: {phpRifCiProveedor:CiRifProv, phpRifCi: selectCiRif, phpProducto:'1'}})
						
		}
		
	}
	
	
}



function cedulaRifProveedor(){
	var selectProv = $F('ciRif');
	var rifci = $F('cedRif');
	var producto = 1;
	
	if (selectProv == '0'){
		$('rif').update("");
		$('mensajeVal').update("");
	}
	if (selectProv == '2'){
		$('rif').update("J-");
		
		
	}
	
	if (selectProv == '1'){
		$('rif').update("");
		
	}
	

	if ((rifci) && (selectProv != '0')){
			new Ajax.Updater('mensajeVal','../php/validarProveedor.php',{method: 'post', parameters: {phpRifCiProveedor:rifci, phpRifCi: selectProv, phpProducto:producto}})
		}
}
