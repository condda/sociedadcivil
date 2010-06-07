<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$cedulaPersona = $_REQUEST['phpCedulaPersona'];
	$montoPago = $_REQUEST['phpMontoPago'];
	$tipoPersona = $_REQUEST['phptipoPersona'];
	
	
	include "../db/cerrar_conexion.php";
?>
	