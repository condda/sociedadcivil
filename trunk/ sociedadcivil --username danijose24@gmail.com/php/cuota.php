<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo5",'id="active"');
$nombre = "Cuotas";
	$pnlmenu->add("nombre",$nombre);	
	
	$pnlmenu->add("opcion1",'<a href="pagoCuota.php">Pago de cuotas</a>');	
	$pnlmenu->add("opcion2",'<a href="consultarCuota.php">Administrar cuotas</a>');	

	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	