<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlcontent = new Panel ("../html/Comprar.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	$pnlmenu->add("opcion3",'<a href="Comprar.php">Comprar</a>');
	$pnlmenu->add("opcion4",'<a href="Venta.php">Venta</a>');
	
	$pnlcontent->add("nombre","Venta");
	$pnlcontent->add("crear",'<a href="crearVenta.php">Crear Venta</a>');
	$pnlcontent->add("consultar",'<a href="consultarVenta.php">Consultar Venta</a>');
	
	
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	