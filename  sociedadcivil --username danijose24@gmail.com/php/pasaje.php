<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlcontent = new Panel("../html/comprar.html");
	
	$pnlcontent->add("nombre",'Pasaje');
	$pnlcontent->add("crear",'<a href="../php/crearPasaje.php">Crear Pasaje</a>');
	$pnlcontent->add("consultar",'<a href="../php/consultarPasaje.php">Consultar Pasaje</a>');
	
	$pnlmain->add("content",$pnlcontent);			
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	