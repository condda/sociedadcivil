<?php

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$cedulaPersona =$_REQUEST['phpCedulaPersona'];
	$cargoPersona =$_REQUEST['phpCargoPersona'];
	
	mysql_query ("insert Into hist_cargo (cedulaPersona,fechaCargo,idJuntadirectiva) values ('$cedulaPersona','$date1','$cargoPersona')");
	echo "Se ha realizado la operacion con exito";
	
	include "../db/cerrar_conexion.php";
?>