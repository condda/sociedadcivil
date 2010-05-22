<?php
	session_start();
	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="crearProducto.php">Crear Producto</a>');
	$pnlmenu->add("opcion2",'<a href="modificarProducto.php">Modificar Producto</a>');
	$pnlmenu->add("opcion3",'<a href="consultarProducto.php">Consultar Producto</a>');
	$pnlmenu->add("opcion4",'<a href="eliminarProducto.php">Eliminar Producto</a>');
	
	$pnlcontent = new Panel("../html/crearProducto.html");
	
	
	
	
	


	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	//include "../db/cerrar_conexion.php";
?>