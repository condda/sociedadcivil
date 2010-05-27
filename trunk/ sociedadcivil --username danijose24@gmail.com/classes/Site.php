<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("$pathFix/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("activo",'id="active"');
	$pnlmain->add("menu",$pnlmenu);

	
	$pnlcontent = new Panel("../html/contentPrincipal.html");
	$result = mysql_query ("Select * from Sociedad");
	$result1 = mysql_fetch_assoc($result);
	
	$pnlcontent->add("historiaSociedad",$result1['descripcionSociedad']);
	$pnlmain->add("content",$pnlcontent);			
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	