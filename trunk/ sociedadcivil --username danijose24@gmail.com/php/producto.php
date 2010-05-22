<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("$pathFix/Panel.php");
	//include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("activo2",'id="active"');
	$pnlmain->add("menu",$pnlmenu);

	
	
	$pnlmain->add("content","HOLA");			
	
	$pnlmain->show();
	//include "../db/cerrar_conexion.php";
?>