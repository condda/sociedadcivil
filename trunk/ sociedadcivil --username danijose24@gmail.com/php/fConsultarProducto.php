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

	extract($_POST);
	$pnlcontent = new Panel("../html/fConsultarProducto.html");
	
	if (($_REQUEST['idproducto']) && ($_REQUEST['idproveedor'])){
		$idproducto =  $_REQUEST['idproducto'];
		$idproveedor =  $_REQUEST['idproveedor'];
		$result = mysql_query("select * from Producto where idProducto = '$idproducto'");
		$result1 = mysql_fetch_assoc($result);	
		$result2 = mysql_query("select * from Producto_Prov where idProducto = '$idproducto' and idProveedor = '$idproveedor'");
		$result3 = mysql_fetch_assoc($result2);			
		$result4 = mysql_query("select * from Proveedor where idProveedor = '$idproveedor'");
		$result5 = mysql_fetch_assoc($result4);	
		$pnlcontent->add("codigo",$result1['idProducto']);					
		$pnlcontent->add("nombre",$result1['nombreProducto']);					
		$pnlcontent->add("descripcion",$result1['descripcionProducto']);
		$pnlcontent->add("proveedor",$result5['nombreProveedor']);					
		$pnlcontent->add("precio",$result3['precioProductoProv']);					
		$pnlcontent->add("cantidad",$result3['cantidadProductoProv']);					
	}		
	else if ($consultarCodigo){
		$result = mysql_query("select * from Producto where idProducto = '$consultarCodigo'");
		$result1 = mysql_fetch_assoc($result);
		$result2 = mysql_query("select * from Producto_Prov where idProducto='$result1[idProducto]'");
		$result3 = mysql_fetch_assoc($result2);
		$result4 = mysql_query("select * from Proveedor where idProveedor='$result3[idProveedor]'");
		$result5 = mysql_fetch_assoc($result4);
		$pnlcontent->add("codigo",$result1['idProducto']);					
		$pnlcontent->add("nombre",$result1['nombreProducto']);					
		$pnlcontent->add("descripcion",$result1['descripcionProducto']);
		$pnlcontent->add("proveedor",$result5['nombreProveedor']);					
		$pnlcontent->add("precio",$result3['precioProductoProv']);					
		$pnlcontent->add("cantidad",$result3['cantidadProductoProv']);					
	}
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>