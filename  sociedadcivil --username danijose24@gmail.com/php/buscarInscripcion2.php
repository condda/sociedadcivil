<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");

	$pnlcontent = new Panel ("../html/buscarInscripcion2.html");
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	
	extract ($_POST);
	
	if(($fechaIni) && ($fechaFin))
	{
		$result =  mysql_query ("SELECT I.*, P.nombrePersona, P.apellidoPersona FROM 
									persona P, Inscripcion I  
									WHERE 								
									I.fechaInscripcion >= '$fechaIni' AND
									I.fechaInscripcion <= '$fechaFin' AND
									I.cedulaPersona = p.cedulaPersona order by I.fechaInscripcion asc");
		
		if($result)
			while($result2 = mysql_fetch_assoc($result))
			{	
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
				
				
				$listaInscripcion = $listaInscripcion.
				'<tr>
					<td align="center">'.$result2['fechaInscripcion'].'</td>
					<td align="center">'.$result2['idInscripcion'].'</td>
					<td align="center">'.$tipoInscripcion.'</td>
					<td align="center">'.$result2['nombrePersona'].' '.$result2['apellidoPersona'].'</td>
					<td align="center">'.$estatusInscripcion .'</td>
					<td align="center">'.$fechaAInscripcion.'</td>
					<td align="center">'.$result2['montoInscripcion'].'</td>
				</tr>';	 
			}
		else
			$pnlcontent->add("mensaje","No existen inscripciones dentro de ese rango de fechas!");	
	}
	else
		$pnlcontent->add("mensaje","Introduzca el rango de fechas!");	

	$pnlcontent->add("listaInscripcion",$listaInscripcion);								
	$pnlcontent->add("fechaIni",$fechaIni);								
	$pnlcontent->add("fechaFin",$fechaFin);								
										
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
?>