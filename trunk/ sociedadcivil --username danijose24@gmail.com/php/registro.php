<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="../classes/Site.php">Socio</a>');
	$pnlmenu->add("opcion2","Avance");

	
	
	$pnlmain->add("menu",$pnlmenu);

	
	
	$pnlmain->add("content","HOLA");			
	$pnlmain->show();
	//include "../db/cerrar_conexion.php";
?>
	