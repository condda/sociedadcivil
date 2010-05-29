<?php
	

	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/plantillaInscripcion.html");
	
	
	
	$pnlmenu->add("activo4",'id="active"');
	
	$pnlcontent->add("nombre","Inscripcion");
	
	//$pnlcontent->add("crear",'<a href="../php/crearAvance.php">Crear Avance</a>');
	$pnlcontent->add("modificar",'<a href="../php/modificarInscripcion.php">Modificar Inscripcion</a>');
	$pnlcontent->add("consultar",'<a href="../php/buscarInscripcion.php">Consultar Inscripcion</a>');
	$pnlcontent->add("eliminar",'<a href="../php/eliminarInscripcion.php">Eliminar Inscripcion</a>');
	
	$pnlmain->add("content",$pnlcontent);
	


	
	
	$pnlmain->add("menu",$pnlmenu);
		

	$pnlmain->show();
	
	
?>