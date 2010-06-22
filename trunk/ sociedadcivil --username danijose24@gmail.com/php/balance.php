<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo7",'id="active"');
	$pnlmenu->add("opcion1",'<a href="ingreso.php">Ingreso</a>');
	$pnlmenu->add("opcion2",'<a href="egreso.php">Egreso</a>');
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	