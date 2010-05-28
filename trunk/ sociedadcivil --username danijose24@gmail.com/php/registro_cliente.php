<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("activo1",'id="active"');
	/*
	
	$pnlcontent->add("crear","Crear");
	$pnlcontent->add("modificar","Modificar");
	$pnlcontent->add("consultar","Consultar");
	$pnlcontent->add("eliminar","Eliminar");*/
	
$pnlcontent = new Panel("../html/contentPrincipal.html");
	$result = mysql_query ("Select * from Sociedad");
	$result1 = mysql_fetch_assoc($result);
	
	$pnlcontent->add("historiaSociedad",$result1['descripcionSociedad']);
	$pnlmain->add("content",$pnlcontent);
	$pnlmenu->add("opcion1",'<a href="../php/socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="../php/avance.php">Avance</a>');
	
	$pnlmain->add("menu",$pnlmenu);
		

	$pnlmain->show();
	
	
?>