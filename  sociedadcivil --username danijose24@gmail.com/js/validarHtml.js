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
	
	var i = 1;
	
	
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
		alert('Debe insertar al menos un producto');
		form.NumeroProducto.focus();
		return (false);
	}else{
	
		var productoNombre = $F('NumeroProducto');
		var productoDescripcion = $F('NumeroProducto');
		var productoPrecio = $F('NumeroProducto');
		var productoCantidad = $F('NumeroProducto');
		
		while(i<=NumeroProducto){
			if(!productoNombre+i){
				alert('Debe insertar el nombre del producto');
				form.productoNombre+i.focus();
				return(false);
				
			}
			else if(!productoDescripcion+i){
				alert('Debe insertar la descripcion');
				form.productoNombre+i.focus();
				return(false);
				
				
			}
			else if(!productoCantidad+i){
				alert('Debe inserar la cantidad del producto');
				form.productoCantidad+i.focus();
				return(false);
			}
			
			if (productoCantidad+i){
				
				if (!/^([0-9])*$/.test(productoCantidad+i)){

				alert("El valor s(" + productoCantidad+i + ") no es un número");
				form.productoCantidad+i.focus();
				return (false);			
				}
		
				
			}
			
		}
		
	}


	
	if (telefono){
		if (!/^([0-9])*$/.test(telefono)){

			alert("El valor (" + telefono + ") no es un número");
			form.telefono.focus();
			return (false);			

		}
	}
		
	return (true);
	
}


function Productos(){
	var NumeroProductos = $F('NumeroProducto');
	var i = 1;
	var lista;
	if (NumeroProductos != '0'){
		$('nombreProducto').update("<BR><h1>Productos</h1>");

		new Ajax.Updater('productos','../php/insertarProducto.php',{method: 'post',parameters: {phpProducto:NumeroProductos}})
	}
	else{
		$('productos').update("");
		$('nombreProducto').update("");
	}
	
	
}