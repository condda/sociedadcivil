<?php

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";

	$cedulaPersona = $_REQUEST['phpCedulaPersona'];
	
	$tipoPersona = $_REQUEST['phpTipoPersona'];
	

	
	$result = mysql_query ("Select * from persona where cedulaPersona = '$cedulaPersona'");
	$result1 = mysql_fetch_assoc($result);
	$nombrePersona = $result1['nombrePersona'];
	$apellidoPersona = $result1['apellidoPersona'];
	
	
	if ($tipoPersona == 1){
		$result = mysql_query ("Select * from sancion S, norma N, tribunald TD where S.cedulaPersonaS = '$cedulaPersona' and S.idNorma = N.idNorma AND S.idTribunald = TD.idTribunald");
		$result1 = mysql_fetch_assoc($result);
		
		if ($result1){
			
			echo '<BR><tr><td><strong>Nombre:&nbsp;</strong>'.$nombrePersona.'</td><td><strong>&nbsp;&nbsp;&nbsp;Apellido:&nbsp;</strong>'.$apellidoPersona.'</td></tr><BR>';
			echo '<tr><td align="center" width="66"><strong>Fecha</strong></td><td align="center"><strong>Motivo</strong></td><td align="center"><strong>Tribunal Disciplinario</strong></td><td align="center"><strong>Tipo Sancion</strong></td></tr>';
			
		}
		
		
		while ($result1){
			
			if ($result1['tipoNorma'] == 1)
			$gravedad = "Suspendido";
			if ($result1['tipoNorma'] == 2)
			$gravedad = "Expulsado";
			
			echo '<tr><td align="center">'.$result1['fechaSancion'].'</td><td align="center">'.$result1['descripcionNorma'].'</td><td align="center">'.$result1['nombre'].'</td><td align="center">'.$gravedad.'</td></tr>';
			
			
			$result1 = mysql_fetch_assoc($result);
		}
		
	
	}
	
	
	if ($tipoPersona == 2){
		
		$result = mysql_query ("Select * from sancion S, norma N, tribunald TD where S.cedulaPersonaA = '$cedulaPersona' and S.idNorma = N.idNorma AND S.idTribunald = TD.idTribunald");
		$result1 = mysql_fetch_assoc($result);
		
		if ($result1){
			
			echo '<BR><tr><td><strong>Nombre:&nbsp;</strong>'.$nombrePersona.'</td><td><strong>&nbsp;&nbsp;&nbsp;Apellido:&nbsp;</strong>'.$apellidoPersona.'</td></tr><BR>';
			echo '<tr><td align="center" width="66"><strong>Fecha</strong></td><td align="center"><strong>Motivo</strong></td><td align="center"><strong>Tribunal Disciplinario</strong></td><td align="center"><strong>Tipo Sancion</strong></td></tr>';
			
		}
		
		
		while ($result1){
			
			if ($result1['tipoNorma'] == 1)
			$gravedad = "Suspendido";
			if ($result1['tipoNorma'] == 2)
			$gravedad = "Expulsado";
			
				echo '<tr><td align="center">'.$result1['fechaSancion'].'</td><td align="center">'.$result1['descripcionNorma'].'</td><td align="center">'.$result1['nombre'].'</td><td align="center">'.$gravedad.'</td></tr>';
			
			
			$result1 = mysql_fetch_assoc($result);
		}
		
		
		
	}
	
	
	
	include "../db/cerrar_conexion.php";
?>