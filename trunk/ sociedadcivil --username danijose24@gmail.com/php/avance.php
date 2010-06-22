<?php
	

	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/plantillaContent.html");
	
	
	
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	$pnlcontent->add("nombre","Avance");
	
	$pnlcontent->add("crear",'<a href="../php/crearAvance.php">Crear Avance</a>');
	$pnlcontent->add("modificar",'<a href="../php/modificarAvance.php">Modificar Avance</a>');
	$pnlcontent->add("consultar",'<a href="../php/buscarAvance.php">Consultar Avance</a>');
	$pnlcontent->add("eliminar",'<a href="../php/eliminarAvance.php">Eliminar Avance</a>');
	
	$pnlmain->add("content",$pnlcontent);
	


	
	
	$pnlmain->add("menu",$pnlmenu);
		

	$pnlmain->show();
	
	
?>