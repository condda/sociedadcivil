<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	$pnlcontent = new Panel("../html/crearProducto.html");
	
	$result = mysql_query("select * from Proveedor");
	while($result1 = mysql_fetch_assoc($result)){
		extract($result1);
		$listaProveedores = $listaProveedores.'<option value="'.$idProveedor.'">'.$nombreProveedor.'</option>';
	}
	$pnlcontent->add("opcion",$listaProveedores);					

	
	extract ($_POST);
	if (($codigo) && ($descripcion) && ($nombre) && ($precio) && ($cantidad) && ($selectProveedor!=0)){
		$result = mysql_query("select idProducto from Producto where idProducto = '$codigo'");
		$result1 = mysql_fetch_assoc($result);
		if ($result1['idProducto']){
			$pnlcontent->add("mensaje","Este Producto ya existe dentro de la Sociedad!");
			$pnlcontent->add("codigo",$codigo);					
			$pnlcontent->add("nombre",$nombre);					
			$pnlcontent->add("descripcion",$descripcion);					
			$pnlcontent->add("precio",$precio);					
			$pnlcontent->add("cantidad",$cantidad);					
		}
		else{
			
			mysql_query("insert into Producto (
			idProducto,
			nombreProducto,
			descripcionProducto) values ('$codigo','$nombre','$descripcion')");
			mysql_query("insert into Producto_Prov (
			idProducto,
			idProveedor,
			precioProductoProv,
			cantidadProductoProv) values ('$codigo','$selectProveedor','$precio','$cantidad')");
			$pnlmenu = new Panel("../html/menu.html");
			$pnlmenu->add("activo",'id="active"');
			$pnlmain = new Panel("../html/main.html");
			$pnlmain->add("nombre","Producto");
			$pnlmain->add("mensaje","Fue registrado exitosamente!");
			$pnlcontent = new Panel("../html/contentPrincipal.html");		
		}
	}
	else{
		$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		$pnlcontent->add("nombre",$nombre);					
		$pnlcontent->add("direccion",$direccion);
		$pnlcontent->add("telefono",$telefono);
		$pnlcontent->add("cedRif",$cedRif);
	}

		
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>