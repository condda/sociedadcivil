<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo5",'id="active"');
$nombre = "Pago de Cuotas";
$pnlcontent = new Panel("../html/plantillaCuota1.html");
	$pnlcontent->add("nombre",$nombre);	
	
	$pnlmenu->add("opcion1",'<a href="pagoCuota.php">Pago de cuotas</a>');	
	$pnlmenu->add("opcion2",'<a href="administrarCuota.php">Administrar cuotas</a>');	


	$pnlcontent->add("crear",'<a href="cuotaOrdinaria.php">Crear pago de cuota</a>');	
	$pnlcontent->add("consultar",'<a href="consultarCuota.php">Consultar cuota</a>');	
	$pnlcontent->add("consultar1",'<a href="consultarCuota1.php">Consultar Cuotas Todos los socios </a>');	
	$pnlcontent->add("consultar2",'<a href="consultarCuota2.php">Consultar Morosos</a>');	

	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	