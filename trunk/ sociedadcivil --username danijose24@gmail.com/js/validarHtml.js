
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
			else if (rifCi == '1')
				$('mensajeVal').update("La cedula debe ser numerica");
			else
				$('mensajeVal').update("");
		}
		else
			new Ajax.Updater('mensajeVal','../php/validarProveedor.php',{method: 'post',parameters: {phpRifCiProveedor:RifCiProveedor, phpRifCi:rifCi}})
			
			
		
	}
	
}
	
	
	
	
function ValidarCampos(form){

	var telefono = $F('telefono');
	var nombre = $F('nombre');
	var direccion = $F('direccion');
	var producto = $F('NumeroProducto');
	var cedRif = $F('cedRif');
	var flag = 0;
	
		
	
	var i = 1;
	
	if (!cedRif){
		
		alert('Debe introducir la cedula o el rif');
		form.cedRif.focus();
		return (false);
		
	}
	if (!nombre){
		alert('Debe introducir un Nombre');
		form.nombre.focus();
		return (false);
	}
	
	
	if (!direccion){
		alert('Debe introducir una direccion');
		form.direccion.focus();
		return (false);
	}
	
	if (!telefono){
		alert('Debe introducir un telefono');
		form.telefono.focus();
		return (false);
	}
	
	if (telefono){
		
		if (!/^([0-9])*$/.test(telefono)){

			alert("El valor (" + telefono + ") no es un número");
			form.telefono.focus();
			return (false);			

		}
	}
	
	if (producto == '0'){
		alert('Debe insertar al menos un producto');
		form.NumeroProducto.focus();
		return (false);
	}	
	
	if (producto != '0'){
	
		
		while(i<=producto){
			
			var productoNombre = $F('nombreProducto'+i);
			var productoDescripcion = $F('descripcionProducto'+i);
			var productoPrecio = $F('precioProducto'+i);
			var productoCantidad = $F('cantidadProducto'+i);
			var productoCodigo = $F('codigoProducto'+i);
			
			if (!productoCodigo){
				
				alert('Debe inserar el codigo del producto');
				flag = 1;
				return (false);
			}
			else if (productoCodigo){
				
				if (!/^([0-9])*$/.test(productoCodigo)){

					alert("El valor (" + productoCodigo + ") no es un número");
					flag = 1;
					return (false);	
				}
			}
			
			if(!productoNombre){
				alert('Debe insertar el nombre del producto');
				flag = 1;
				return (false);
				
			}
			
			
			if(!productoDescripcion){
				alert('Debe insertar la descripcion');
				flag = 1;
				return (false);
				
				
			}
			
			if(!productoPrecio){
				alert('Debe inserar el precio del producto');
				flag = 1;
				return (false);
			}
			
			else if (productoPrecio){
				
				if (!/^([0-9])*$/.test(productoPrecio)){

					alert("El valor (" + productoPrecio + ") no es un número");
					flag = 1;
					return (false);			
				}
		
				
			}
			
			
			if(!productoCantidad){
				alert('Debe inserar la cantidad del producto');
				flag = 1;
				return (false);
			}
			
			else if (productoCantidad){
				
				if (!/^([0-9])*$/.test(productoCantidad)){

					alert("El valor (" + productoCantidad + ") no es un número");
					flag = 1;
					return (false);			
				}
		
				
			}
		
			i++;

		}
		
	
		i = 1;
		flag =0;
		var j = 1;
		
		while (i<=producto){
			var productoCodigoI = $F('codigoProducto'+i);
			j = i+1;
			while (j<=producto){
				var productoCodigoJ = $F('codigoProducto'+j);
				if (productoCodigoI == productoCodigoJ){
					alert("Hay codigos repetidos");
					return (false);
				}
				j++;
			}
			i++;
		}
		
		
		
		
	}
	
	if ( ($F('flagProducto') == '1') || ($F('flagProveedor') == '1') ){
		alert("Hay uno o mas errores en los formularios");
		return (false);
	}

return (true);
}
		
	
	


function Productos(){
	var NumeroProductos = $F('NumeroProducto');
	var i = 1;
	var lista;
	if (NumeroProductos != '0'){
		
		new Ajax.Updater('productos','../php/insertarProducto.php',{method: 'post',parameters: {phpProducto:NumeroProductos}})
	}
	else{
		$('productos').update("");
		$('nombreProducto').update("");
	}
	
	
}


function ValidarCodigoProducto(i){
	
	var productoCodigo = $F('codigoProducto'+i);
	$('mensajeProducto').update("Cargando...");
	
	
	if (!/^([0-9])*$/.test(productoCodigo)){
			$('mensajeProducto').update("El Codigo debe ser numerico");
						
	}
	else	
		new Ajax.Updater('mensajeProducto','../php/validarProducto.php',{method: 'post',parameters: {phpproductoCodigo:productoCodigo}})
	
	
}