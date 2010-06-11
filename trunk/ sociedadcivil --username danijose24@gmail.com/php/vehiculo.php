<?php
	

	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/plantillaContent.html");
		
	
	$pnlmenu->add("activo3",'id="active"');
	

	
	$pnlcontent->add("nombre","Vehiculo");
	$pnlcontent->add("crear",'<a href="../php/crearVehiculo.php">Crear Vehiculo</a>');

	$pnlcontent->add("modificar",'<a href="../php/xmodificarVehiculo.php">Modificar Vehiculo</a>');


	$pnlcontent->add("consultar",'<a href="../php/consultarVehiculo.php">Consultar Vehiculo</a>');
	$pnlcontent->add("eliminar",'<a href="../php/eliminarVehiculo.php">Eliminar Vehiculo</a>');
	
	$pnlmain->add("content",$pnlcontent);
	
	
	$pnlmain->add("menu",$pnlmenu);
		

	$pnlmain->show();
	
	
?>