<?php

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";

	$cedulaPersona = $_REQUEST['phpCedulaPersona'];
	$tipoPersona = $_REQUEST['phpTipoPersona'];
	
	if ($tipoPersona == 1){
		
		$result = mysql_query (" select P.nombrePersona, P.apellidoPersona from socio S, persona P, inscripcion I where S.cedulaPersona = '$cedulaPersona' and S.cedulaPersona = P.cedulaPersona AND P.cedulaPersona = I.cedulaPersona and I.estatusInscripcion <> '5' AND I.estatusInscripcion <> '2' AND I.estatusInscripcion <> '6'");
		
		$result1 = mysql_fetch_assoc($result);
		
		if ($result1){
			
			echo '<br><tr><td><strong>Nombre:&nbsp;</strong>'.$result1['nombrePersona'].'</td><td><strong>&nbsp;&nbsp;&nbsp;Apellido:&nbsp;</strong>'.$result1['apellidoPersona'].'</td><td><strong>&nbsp;&nbsp;&nbsp;Tipo de Inscripcion:&nbsp;</strong>Socio</td></tr>';
			echo '<input name="flag" type="hidden" id="flag" value="1" />';
		}
		else{
			echo "No se encuentra la cedula en nuestra base de datos o la persona esta rechazada,suspendida o expulsada";
			echo '<input name="flag" type="hidden" id="flag" value="2" />';
		}
	}
	
	
	if ($tipoPersona == 2){
		
		$result = mysql_query (" select P.nombrePersona, P.apellidoPersona from avance A, persona P, inscripcion I where A.cedulaPersona = '$cedulaPersona' and A.cedulaPersona = P.cedulaPersona AND P.cedulaPersona = I.cedulaPersona and I.estatusInscripcion <> '5' AND I.estatusInscripcion <> '2' AND I.estatusInscripcion <> '6'");
		$result1 = mysql_fetch_assoc($result);
		
		if ($result1){
			
			echo '<br><tr><td><strong>Nombre:&nbsp;</strong>'.$result1['nombrePersona'].'</td><td><strong>&nbsp;&nbsp;&nbsp;Apellido:&nbsp;</strong>'.$result1['apellidoPersona'].'</td><td><strong>&nbsp;&nbsp;&nbsp;Tipo de Inscripcion:&nbsp;</strong>Avance</td></tr>';
			echo '<input name="flag" type="hidden" id="flag" value="1" />';
			
		}
		else{
			echo "No se encuentra la cedula en nuestra base de datos o la persona esta rechazada,suspendida o expulsada";
			echo '<input name="flag" type="hidden" id="flag" value="2" />';
			
		}
		
	}
	
	
	include "../db/cerrar_conexion.php";
?>