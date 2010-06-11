<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');

	$pnlcontent = new Panel("../html/Comprar.html");
	
	$pnlcontent->add("nombre",'Retirar Socio/Avance');
	$pnlcontent->add("crear",'<a href="fCrearRetiro.php">Crear Retiro</a>');
	$pnlcontent->add("consultar",'<a href="fConsultarRetiro.php">Consultar Retiro</a>');

	
	$pnlmain->add("content",$pnlcontent);
	
	

	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>