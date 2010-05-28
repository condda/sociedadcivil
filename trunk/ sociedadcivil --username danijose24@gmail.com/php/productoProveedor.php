<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	
	
	$pnlcontent = new Panel("../html/contentPrincipal.html");
	$result = mysql_query ("Select * from Sociedad");
	$result1 = mysql_fetch_assoc($result);
	
	$pnlcontent->add("historiaSociedad",$result1['descripcionSociedad']);
	
	
	$pnlmain->add("content",$pnlcontent);
	
	$pnlmain->add("menu",$pnlmenu);

	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	