<?php
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$tipoCargo = $_REQUEST['phpTipoCargo'];
	$nombreCargo = $_REQUEST['phpNombreCargo'];
	$descripcionCargo= $_REQUEST['phpDescripcionCargo'];
	
	if ($tipoCargo == 1){
		
	mysql_query("insert into juntadirectiva (nombreJuntadirectiva, descripcionJuntadirectiva) values ('$nombreCargo','$descripcionCargo')");		
		echo "El cargo se ha creado con exito";
		
	}
	
	if ($tipoCargo == 2){
		
		
	}
	include "../db/cerrar_conexion.php";
?>