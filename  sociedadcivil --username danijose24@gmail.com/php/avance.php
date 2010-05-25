<?php
	

	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/plantillaContent.html");
	
	
	
	$pnlmenu->add("activo1",'id="active"');
	$pnlcontent->add("crear",'<a href="../php/crearAvance.php">Crear Avance</a>');
	$pnlcontent->add("modificar",'<a href="../php/modificarSocio.php">Modificar Avance</a>');
	$pnlcontent->add("consultar",'<a href="../php/consultarSocio.php">Consultar Avance</a>');
	$pnlcontent->add("eliminar",'<a href="../php/eliminarSocio.php">Eliminar Avance</a>');
	
	$pnlmain->add("content",$pnlcontent);
	


	
	
	$pnlmain->add("menu",$pnlmenu);
		

	$pnlmain->show();
	
	
?>