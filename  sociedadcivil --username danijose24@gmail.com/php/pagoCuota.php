<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo5",'id="active"');
$nombre = "Pago de Cuotas";
$pnlcontent = new Panel("../html/plantillaCuota.html");
	$pnlcontent->add("nombre",$nombre);	
	$pnlcontent->add("crear",'<a href="cuotaOrdinaria.php">Crear pago de cuota</a>');	
	$pnlcontent->add("consultar",'<a href="consultarCuota.php">Consulta cuota</a>');	

	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	