<?php
	
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	/********INICIO*************/
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/consultarVehiculo.html");	
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	
	//Consulta BD
	
	$vehiculoBDS = mysql_query("SELECT * FROM vehiculo, traspaso
							  WHERE traspaso.idVehiculo = vehiculo.idVehiculo");
	
	//Traduccion de Datos
	
	$vehiculoS = mysql_fetch_assoc($vehiculoBDS);
	
			while($vehiculoS)
			{
						$datos = $datos.'<option value="'.$vehiculoS['placaVehiculo'].'">'.$vehiculoS['placaVehiculo'].'</option>';						
						
						$vehiculoS = mysql_fetch_assoc($vehiculoBDS);
			}
	
	//Consulta BD
	
	$vehiculoBD = mysql_query("SELECT * FROM vehiculo, persona, traspaso
							   WHERE persona.cedulaPersona = traspaso.cedulaPersona AND
							   traspaso.idVehiculo = vehiculo.idVehiculo");
	
	//Traduccion de Datos
	
	$vehiculo = mysql_fetch_assoc($vehiculoBD);
	
	while($vehiculo)
	{
		$listaDEVEHICULOS = $listaDEVEHICULOS.'<tr>
		<td>'.$vehiculo['nombrePersona'].' '.$vehiculo['apellidoPersona'].'</td>
		<td>'.$vehiculo['placaVehiculo'].'</td>
		<td>'.$vehiculo['anoVehiculo'].'</td>
		<td>'.$vehiculo['polizaVehiculo'].'</td>
		<td>'.$vehiculo['estadoVehiculo'].'</td>
		</tr>';
		$vehiculo = mysql_fetch_assoc($vehiculoBD);
		
	}
			
			
		
		$placaXXX = $_REQUEST['lista'];
		
		if($placaXXX)
		{
			
				//Consulta BD
								
				
				$usuarioBD = mysql_query("SELECT *
												FROM vehiculo v, traspaso t, persona p 
												WHERE v.idVehiculo = t.idVehiculo
												AND v.placaVehiculo ='$placaXXX'
												AND p.cedulaPersona = t.cedulaPersona
												AND t.listaTraspaso = 0
												
										   ");
		
				
				//Traduccion de Datos
				
				$usuario = mysql_fetch_assoc($usuarioBD);
				
				$id=$usuario['idVehiculo'];
				
				$avanceBD = mysql_query("SELECT * FROM persona p, vehiculo_avance va
									  WHERE va.idVehiculo = '$id' AND va.cedulaPersona = p.cedulaPersona");
				
				$avance = mysql_fetch_assoc($avanceBD);
				
				
					$lista2 = $lista2.'<tr>
					<td>'.$usuario['nombrePersona'].' '.$usuario['apellidoPersona'].'</td>
					<td>'.$avance['nombrePersona'].' '.$avance['apellidoPersona'].'</td>
					<td>'.$usuario['placaVehiculo'].'</td>
					<td>'.$usuario['anoVehiculo'].'</td>
					<td>'.$usuario['polizaVehiculo'].'</td>
					<td>'.$usuario['estadoVehiculo'].'</td>
					</tr>';
			
				$tabla = '<table width="913" border="0">
							<tr>
							  <td width="186"><strong>Socio</strong></td>
							  <td width="186"><strong>Avance</strong></td>
							  <td width="126"><strong>Vehiculo - Placa</strong></td>
							  <td width="60"><strong>Anio</strong></td>
							  <td width="104"><strong>Poliza</strong></td>
							  <td width="415"><strong>Estado</strong></td>
							</tr>
							{lista2}
						  </table>';
				
				$pnlcontent->add("yujulu",$tabla);
				$pnlcontent->add("lista2",$lista2);
	
			
		}
		
	/************FINAL*****************/	
	$pnlcontent->add("listaVehiculos",$datos);
	$pnlcontent->add("listaDEVEHICULOS",$listaDEVEHICULOS);
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);


	$pnlmain->show();
	
	
?>