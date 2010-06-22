<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");

	$pnlcontent = new Panel ("../html/buscarInscripcion.html");
	$pnlmenu->add("activo4",'id="active"');
	
	

	$fechaI = $_REQUEST['fechaI'];
	$fechaF = $_REQUEST['fechaF'];
	

	
if(($fechaI!=NULL) && ($fechaF!=NULL))
	{

			
			$result = mysql_query ("select  I.fechaInscripcion as fechaInscripcion, I.idInscripcion as idInscripcion, I.tipoInscripcion as tipoInscripcion, I.estatusInscripcion as estatusInscripcion,I.fechaAInscripcion as fechaAInscripcion,I.montoInscripcion as montoInscripcion,P.nombrePersona as nombrePersona  , P.apellidoPersona as apellidoPersona FROM persona P, Inscripcion I  where I.fechaInscripcion between '$fechaI' and '$fechaF' and I.cedulaPersona = P.cedulaPersona order by I.fechaInscripcion ");
	
			$flag = 0;
			while ($result2 = mysql_fetch_assoc($result))
			{	

			$flag = 1;
			if ($result2['tipoInscripcion'] == '1')
				$tipoInscripcion = "Socio";
				
			else
			$tipoInscripcion = "Avance";
			
			if ($result2['fechaAInscripcion'] == '0000-00-00')
			$fechaAInscripcion = "No admitido";
			else
			$fechaAInscripcion = $result2['fechaAInscripcion'];
			
			if ($result2['estatusInscripcion'] == '1')
				$estatusInscripcion = "Aprobado";
			else if ($result2['estatusInscripcion'] == '2')
				$estatusInscripcion = "Rechazado";
			else if ($result2['estatusInscripcion'] == '3')
				$estatusInscripcion = "En Espera";
			else if ($result2['estatusInscripcion'] == '4')
				$estatusInscripcion = "Periodo de Prueba";
			else if ($result2['estatusInscripcion'] == '5')
				$estatusInscripcion = "Expulsado";
			
			
				$consultaInscripcion = $consultaInscripcion.'<tr>
				<td align="center">'.$result2['fechaInscripcion'].'</td>
				<td align="center">'.$result2['idInscripcion'].'</td>
				<td align="center">'.$tipoInscripcion.'</td>
				<td align="center">'.$result2['nombrePersona'].' '.$result1['apellidoPersona'].'</td>
				<td align="center">'.$estatusInscripcion .'</td>
				<td align="center">'.$fechaAInscripcion.'</td>
				<td align="center">'.$result2['montoInscripcion'].'</td>
				</tr>';	 
			
			
			}
			if (($flag == 0) && (!$result2)){
				
				$pnlcontent->add("mensaje","No se encuentran inscripciones entre esas fechas");								
			}
			
	}
	
	
	$result =  mysql_query ("SELECT I.fechaInscripcion as fechaInscripcion, I.idInscripcion as idInscripcion, I.tipoInscripcion as tipoInscripcion, I.estatusInscripcion as estatusInscripcion,I.fechaAInscripcion as fechaAInscripcion,I.montoInscripcion as montoInscripcion,P.nombrePersona as nombrePersona  , P.apellidoPersona as apellidoPersona FROM persona P, Inscripcion I WHERE I.cedulaPersona= P.cedulaPersona order by I.fechaInscripcion");
	
	while ($result1 = mysql_fetch_assoc($result))
	{//while
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
			
			
				$listaInscripcion = $listaInscripcion.'<tr>
				<td align="center">'.$result1['fechaInscripcion'].'</td>
				<td align="center">'.$result1['idInscripcion'].'</td>
				<td align="center">'.$tipoInscripcion.'</td>
				<td align="center">'.$result1['nombrePersona'].' '.$result1['apellidoPersona'].'</td>
				<td align="center">'.$estatusInscripcion .'</td>
				<td align="center">'.$fechaAInscripcion.'</td>
				<td align="center">'.$result1['montoInscripcion'].'</td>
				</tr>';	 
				
	}//while
		$pnlcontent->add("consultaInscripcion",$consultaInscripcion);								
		$pnlcontent->add("listaInscripcion",$listaInscripcion);								
										
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	
	
?>