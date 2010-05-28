<?php
	

	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/plantillaContent.html");
		
	
	$pnlmenu->add("activo1",'id="active"');
	

	
	
	$pnlcontent->add("crear",'<a href="../php/crearVehiculo.php">Crear Vehiculo</a>');
	$pnlcontent->add("modificar",'<a href="../php/modificarSocio.php">Modificar Vehiculo</a>');
	$pnlcontent->add("consultar",'<a href="../php/buscarSocio.php">Consultar Vehiculo</a>');
	$pnlcontent->add("eliminar",'<a href="../php/eliminarSocio.php">Eliminar Vehiculo</a>');
	
	$pnlmain->add("content",$pnlcontent);
	
	
	$pnlmain->add("menu",$pnlmenu);
		

	$pnlmain->show();
	
	
?>