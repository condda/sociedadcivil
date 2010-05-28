<?php
	

	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/plantillaContent.html");
	
	$pnlcontent->add("nombre","Socio");
	
	$pnlmenu->add("activo1",'id="active"');
	

	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	
	$pnlcontent->add("crear",'<a href="../php/crearSocio.php">Crear Socio</a>');
	$pnlcontent->add("modificar",'<a href="../php/modificarSocio.php">Modificar Socio</a>');
	$pnlcontent->add("consultar",'<a href="../php/buscarSocio.php">Consultar Socio</a>');
	$pnlcontent->add("eliminar",'<a href="../php/eliminarSocio.php">Eliminar Socio</a>');
	
	$pnlmain->add("content",$pnlcontent);
	
	
	$pnlmain->add("menu",$pnlmenu);
		

	$pnlmain->show();
	
	
?>