function llenadoProveedores(){
	$('ejemplo').update("Cargando...");
	var proveedor = $F('selectProveedor');
	new Ajax.Updater('ejemplo','../php/validarProveedor.php',{method: 'post',parameters: {phpProveedor:proveedor}})
	
}


function validarCedulaProveedor(){
	
	var RifCiProveedor = $F('cedRif');
	var rifCi = $F('ciRif');
	
	
	
	if (rifCi == '2'){
		$('rif').update("J-");
	}
	else
	$('rif').update("");
	
	if ((rifCi) &&(RifCiProveedor)){
		$('mensajeVal').update("Cargando...");
		if (!/^([0-9])*$/.test(RifCiProveedor)){
			if (rifCi == '2')
				$('mensajeVal').update("El rif debe ser numerico");
			else
				$('mensajeVal').update("La cedula debe ser numerica");
		}
		else
			new Ajax.Updater('mensajeVal','../php/validarProveedor.php',{method: 'post',parameters: {phpRifCiProveedor:RifCiProveedor, phpRifCi:rifCi}})
			
	}
	
}
	
	
	
	
function ValidarTelefono(form){

	var telefono = $F('telefono');
	var nombre = $F('nombre');
	var direccion = $F('direccion');
	var producto = $F('NumeroProducto');
	
	if (!nombre){
		alert('Debe introducir un Nombre');
		form.nombre.focus();
		return (false);
	}
	else if (!direccion){
		alert('Debe introducir una direccion');
		form.direccion.focus();
		return (false);
	}
	
	else if (!telefono){
		alert('Debe introducir un telefono');
		form.telefono.focus();
		return (false);
	}
	else if (producto == '0'){
		alert('Debe inserar al menos un producto');
		form.NumeroProducto.focus();
		return (false);
	}

	
	if (telefono){
		if (!/^([0-9])*$/.test(telefono)){
			if (!/^([0-9])*$/.test(telefono)){
			alert("El valor (" + telefono + ") no es un número");
			form.telefono.focus();
			return (false);			
			}
		}
	}
		
	return (true);
	
}


function Productos(){
	var NumeroProductos = $F('NumeroProducto');
	
	if (NumeroProductos != '0')
		new Ajax.Updater('productos','../php/insertarProducto.php',{method: 'post',parameters: {phpProducto:NumeroProductos}})
	else
		$('productos').update("");
	
	
}