<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("$pathFix/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	
	
	
	$pnlmain->add("content",);			
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	