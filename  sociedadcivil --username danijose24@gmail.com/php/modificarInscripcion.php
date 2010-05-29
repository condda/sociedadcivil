<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
		
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo4",'id="active"');

	
	$pnlcontent = new Panel("../html/modificarInscripcion.html");
	
	$modificarCodigo = $_REQUEST['modificarCodigo'];
	if ($modificarCodigo){
		$result = mysql_query("select idInscripcion from Inscripcion where idInscripcion = '$modificarCodigo'");
		$result1 = mysql_fetch_assoc($result);
		if (!$result1){
			$pnlcontent->add("mensaje","Esta inscripcion no existe dentro de la Sociedad!");
			$pnlcontent->add("modificarCodigo",$modificarCodigo);					
		}
	}
	else{
		$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		$pnlcontent->add("modificarCodigo",$modificarCodigo);					
	}
		
	$result = mysql_query("SELECT I.fechaInscripcion as fechaInscripcion, I.idInscripcion as idInscripcion, I.tipoInscripcion as tipoInscripcion, I.estatusInscripcion as estatusInscripcion,I.fechaAInscripcion as fechaAInscripcion,I.montoInscripcion as montoInscripcion,P.nombrePersona as nombrePersona  , P.apellidoPersona as apellidoPersona FROM persona P, Inscripcion I WHERE I.cedulaPersona= P.cedulaPersona");
	
	while ($result1 = mysql_fetch_assoc($result)){
		if ($result1['tipoInscripcion'] == '1')
				$tipoInscripcion = "Socio";
				
			else
			$tipoInscripcion = "Avance";
			
			if ($result1['fechaAInscripcion'] == '0000-00-00')
			$fechaAInscripcion = "No admitido";
			else
			$fechaAInscripcion = $result1['fechaAInscripcion'];
			
			if ($result1['estatusInscripcion'] == '1')
				$estatusInscripcion = "Aprobado";
			else if ($result1['estatusInscripcion'] == '2')
				$estatusInscripcion = "Rechazado";
			else if ($result1['estatusInscripcion'] == '3')
				$estatusInscripcion = "En Espera";
			else if ($result1['estatusInscripcion'] == '4')
				$estatusInscripcion = "Periodo de Prueba";
			else if ($result1['estatusInscripcion'] == '5')
				$estatusInscripcion = "Expulsado";
			
			
				$consultaInscripcion = $consultaInscripcion.'<tr>
				<td align="center">'.$result1['fechaInscripcion'].'</td>
				<td align="center">'.$result1['idInscripcion'].'</td>
				<td align="center">'.$tipoInscripcion.'</td>
				<td align="center">'.$result1['nombrePersona'].' '.$result1['apellidoPersona'].'</td>
				<td align="center">'.$estatusInscripcion .'</td>
				<td align="center">'.$fechaAInscripcion.'</td>
				<td align="center">'.$result1['montoInscripcion'].'</td>
				<td><a href="../php/fModificarInscripcion.php?idInscripcion='.$result1['idInscripcion'].'">Modificar</a></td></tr>';
	}
	$pnlcontent->add("consultaInscripcion",$consultaInscripcion);
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>