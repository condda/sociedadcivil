<?php
	
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	/********INICIO*************/
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/consultarVehiculo.html");	
	$pnlmenu->add("activo3",'id="active"');
	
	
	/*****************BASE DE DATOS****************/
	
	
	
	
	/***************FINAL********************/
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);


	$pnlmain->show();
	
	
?>