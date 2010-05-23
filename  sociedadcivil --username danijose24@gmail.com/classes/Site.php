<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("$pathFix/Panel.php");
	//include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("activo",'id="active"');
	$pnlmain->add("menu",$pnlmenu);

	
	$pnlcontent = new Panel("../html/contentPrincipal.html");
	$pnlmain->add("content",$pnlcontent);			
	
	$pnlmain->show();
	//include "../db/cerrar_conexion.php";
?>
	