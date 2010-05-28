<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');

	
	$pnlcontent = new Panel ("../html/eliminarAvance.html");	
	
	$pnlmenu->add("activo1",'id="active"');
	
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);	
	
	$eliminarId = $_REQUEST['id'];
	
	if ($eliminarId){
		
		mysql_query("DELETE from  avance where cedulaPersona = '$eliminarId'");
		$result =  mysql_query ("select idVehiculo from vehiculo_avance where cedulaPersona = '$eliminarId'");
		while ($result1 = mysql_fetch_assoc($result)){
		$idVehiculo = $result1['idVehiculo'];
		mysql_query("delete from vehiculo_avance where cedulaPersona = '$eliminarId' AND idVehiculo='$idVehiculo'");
		
		
		
		}
	}
	if($cedula!=NULL)
	{
			
			
			$result =  mysql_query ("SELECT * FROM persona P, avance A WHERE A.cedulaPersona = '$cedula' AND A.cedulaPersona = P.cedulaPersona ");
			
			if ($result2 = mysql_fetch_assoc($result))
			{	
				$informacion2 = 	$informacion2.'<tr>
				<td align="center">'.$result2['cedulaPersona'].'</td>
				<td align="center">'.$result2['nombrePersona'].'</td>
				<td align="center">'.$result2['apellidoPersona'].'</td>
				<td align="center">'.$result2['telefonoPersona'].'</td>
				<td align="center">'.$result2['direccionPersona'].'</td>
				<td align="center">'.$result2['nacionalidadPersona'].'</td>
				<td align="center">'.$result2['sexoPersona'].'</td>
				<td align="center">'.$result2['fechaNPersona'].'</td>
				<td align="center">'.$result2['estadoCPersona'].'</td>
				<td align="center">'.$result2['fechaLPersona'].'</td>
				<td align="center">'.$result2['nombreCPersona'].'</td>
				<td align="center"><a href="../php/eliminarAvance.php?id='.$result2['cedulaPersona'].'">Eliminar</a></td>
				</tr>';	 
			
			}
			else
			{	
					$pnlcontent->add("mensaje","No ha sido registrado un socio con esa cedula.");	
			}
	}
	
	
	$result =  mysql_query ("SELECT * FROM persona P, avance A WHERE A.cedulaPersona = P.cedulaPersona ",$conexion);
	
	while ($result1 = mysql_fetch_assoc($result))
	{//while
				$informacion = 	$informacion.'<tr>
				<td align="center">'.$result1['cedulaPersona'].'</td>
				<td align="center">'.$result1['nombrePersona'].'</td>
				<td align="center">'.$result1['apellidoPersona'].'</td>
				<td align="center">'.$result1['telefonoPersona'].'</td>
				<td align="center">'.$result1['direccionPersona'].'</td>
				<td align="center">'.$result1['nacionalidadPersona'].'</td>
				<td align="center">'.$result1['sexoPersona'].'</td>
				<td align="center">'.$result1['fechaNPersona'].'</td>
				<td align="center">'.$result1['estadoCPersona'].'</td>
				<td align="center">'.$result1['fechaLPersona'].'</td>
				<td align="center">'.$result1['nombreCPersona'].'</td>
				<td align="center"><a href="../php/eliminarAvance.php?id='.$result1['cedulaPersona'].'">Eliminar</a></td>
				</tr>';
				
	}//while
		$pnlcontent->add("informacion2",$informacion2);								
		$pnlcontent->add("informacion",$informacion);								
										
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);

	$pnlmain->show();
	
	
?>