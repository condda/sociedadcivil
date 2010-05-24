function llenadoProveedores(){
	$('ejemplo').update("Cargando...");
	var proveedor = $F('selectProveedor');
	new Ajax.Updater('ejemplo','../php/validarProveedor.php',{method: 'post',parameters: {phpProveedor:proveedor}})
	
}


function validarCedulaProveedor(){
	$('ejemplo').update("Cargando...");
	//var RifCiProveedor = $F('cedRif');
	//var rifCi = $F('ciRif');
	//new Ajax.Updater('cedulaProveedor','../php/validarProveedor.php',{method: 'post',parameters: {phpRifCiProveedor:RifCiProveedor, phpRifCi:rifCi}})
	
	
	}