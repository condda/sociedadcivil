<?php
	

	require_once ("../classes/Panel.php");
	//include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel("../html/registro_persona.html");
	
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="../classes/Site.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="../classes/Site.php">Avance</a>');
	
	//$pnlmenu->add("opcion1","Socio");
	//$pnlmenu->add("opcion2","Avance");
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);

	$pnlmain->show();
	
	
?>