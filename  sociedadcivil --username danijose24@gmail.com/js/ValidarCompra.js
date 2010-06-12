function llenarProducto(){

	var idProveedor = $F('proveedor');
	$('precio').update("");
	if (idProveedor != 0){
	new Ajax.Updater('listaProducto','../php/llenarProducto.php',{method: 'post',parameters: {phpidProveedor:idProveedor}})	
	
	$('nombreSelect').update("Producto");
	}
	else{
	$('listaProducto').update("");
	$('nombreSelect').update("");
	$('boton').update("Cargando...");
		$('totalCompra').update("");
	}
	
	
}


function precioProducto(){
	
	var idProducto = $F('producto');
	var idProveedor = $F('proveedor');
	
	$('precio').update("Cargando...");
	
	if (idProducto != 0){
	new Ajax.Updater('precio','../php/llenarProducto.php',{method: 'post',parameters: {phpidProducto:idProducto,phpidProveedor:idProveedor}})	
	
	}
	else{
	$('precio').update("");
	$('boton').update("Cargando...");
	$('totalCompra').update("");
	}
	
	
	
}


function anadirBoton(){
	$('boton').update("Cargando...");
	$('totalCompra').update("Cargando...");
	var idProducto = $F('producto');
	var idProveedor = $F('proveedor');
	var cantidadProducto = $F('cantidadProducto');
	if (cantidadProducto != 0){
		new Ajax.Updater('boton','../php/llenarProducto.php',{method: 'post',parameters: {phpcantidadProducto:cantidadProducto}})	
		new Ajax.Updater('totalCompra','../php/llenarProducto.php',{method: 'post',parameters: {phpidProducto:idProducto,phpidProveedor:idProveedor,phpcant:cantidadProducto}})	
	}
	else{
		$('totalCompra').update("");
		$('boton').update("");
	}
}