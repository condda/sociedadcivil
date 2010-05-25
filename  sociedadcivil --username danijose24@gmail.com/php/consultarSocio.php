<?php
	

	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/buscarSocio.html");	
	
	
	$pnlmenu->add("activo1",'id="active"');
	
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);	
		

	$pnlmain->show();
	
	
?>