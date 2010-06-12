<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
		
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	$pnlmenu->add("opcion3",'<a href="Comprar.php">Comprar</a>');
	$pnlmenu->add("opcion4",'<a href="Venta.php">Venta</a>');

	
	$pnlcontent = new Panel("../html/modificarProducto.html");
	
	$modificarCodigo = $_REQUEST['modificarCodigo'];
	if ($modificarCodigo){
		$result = mysql_query("select idProducto from Producto where idProducto = '$modificarCodigo'");
		$result1 = mysql_fetch_assoc($result);
		if (!$result1){
			$pnlcontent->add("mensaje","Este Producto no existe dentro de la Sociedad!");
			$pnlcontent->add("modificarCodigo",$modificarCodigo);					
		}
	}
	else{
		$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		$pnlcontent->add("modificarCodigo",$modificarCodigo);					
	}
		
	$result = mysql_query("select * from Producto");
	
	while ($result1 = mysql_fetch_assoc($result)){
		$result2 = mysql_query("select * from Producto_Prov where idProducto='$result1[idProducto]'");
		$result3 = mysql_fetch_assoc($result2);
		$result4 = mysql_query("select * from Proveedor where idProveedor='$result3[idProveedor]'");
		$result5 = mysql_fetch_assoc($result4);
		$listaProducto = $listaProducto.
		'<tr><td>'.$result1['idProducto'].'</td>
		<td>'.$result1['nombreProducto'].'</td>
		<td>'.$result1['descripcionProducto'].'</td>
		<td>'.$result5['nombreProveedor'].'</td>
		<td>'.$result3['precioProductoProv'].'</td>
		<td>'.$result3['cantidadProductoProv'].'</td>
		<td><a href="../php/fModificarProducto.php?idproducto='.$result1['idProducto'].'&idproveedor='.$result5['idProveedor'].'">Modificar</a></td></tr>';
	}
	$pnlcontent->add("modificarProducto",$listaProducto);
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>