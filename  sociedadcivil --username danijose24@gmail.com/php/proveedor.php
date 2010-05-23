<?php
	session_start();
	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');

	$pnlcontent = new Panel("../html/plantillaContent.html");
	
	$pnlcontent->add("nombre",'Proveedor');
	$pnlcontent->add("crear",'<a href="crearProveedor.php">Crear Proveedor</a>');
	$pnlcontent->add("modificar",'<a href="modificarProveedor.php">Modificar Proveedor</a>');
	$pnlcontent->add("eliminar",'<a href="eliminarProveedor.php">Eliminar Proveedor</a>');
	$pnlcontent->add("consultar",'<a href="consultarProveedor.php">Consultar Proveedor</a>');
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	
	$pnlmain->show();
	//include "../db/cerrar_conexion.php";
?>
	