<?php

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";

	$cedulaPersona = $_REQUEST['phpCedulaPersona'];
	$idNorma = $_REQUEST['phpIdNorma'];
	$tipoPersona = $_REQUEST['phpTipoPersona'];
	$idTribunald = $_REQUEST['phpTipoPersona'];

	$result = mysql_query ("select * from norma where idNorma = '$idNorma'");
	$result1 = mysql_fetch_assoc($result);
	$tipoNorma = $result1['tipoNorma'];
	
	$result = mysql_query("select * from inscripcion where cedulaPersona = '$cedulaPersona' and tipoInscripcion = '$tipoPersona'");
		$result1 = mysql_fetch_assoc($result);
		$idInscripcion = $result1['idInscripcion'];
	
	if ($tipoPersona == 1){
		
		mysql_query ("insert into sancion (fechaSancion,idNorma,idTribunald,cedulaPersonaS) values ('$date1','$idNorma','$idTribunald','$cedulaPersona')");
		
		if ($tipoNorma == 1){
	
		mysql_query ("update inscripcion set estatusInscripcion = '6' where idInscripcion = '$idInscripcion'");		
			
		}
		if ($tipoNorma == 2){
		
	
		mysql_query ("update inscripcion set estatusInscripcion = '5' where idInscripcion = '$idInscripcion'");		
		
		}
		
	
	}
	
	if ($tipoPersona == 2){
		
		mysql_query ("insert into sancion (fechaSancion,idNorma,idTribunald,cedulaPersonaA) values ('$date1','$idNorma','$idTribunald','$cedulaPersona')");
		
		if ($tipoNorma == 1){
	
		mysql_query ("update inscripcion set estatusInscripcion = '6' where idInscripcion = '$idInscripcion'");		
			
		}
		if ($tipoNorma == 2){
		
	
		mysql_query ("update inscripcion set estatusInscripcion = '5' where idInscripcion = '$idInscripcion'");		
		
		}
		
		
	}
	
	
	
	include "../db/cerrar_conexion.php";
?>