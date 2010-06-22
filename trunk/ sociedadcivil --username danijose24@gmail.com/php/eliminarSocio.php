<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');

	$pnlcontent = new Panel ("../html/eliminarSocio.html");	
	
	$pnlmenu->add("activo1",'id="active"');
	
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);	
	
	$eliminarId = $_REQUEST['id'];
	
	if ($eliminarId){
		
		mysql_query("DELETE from  socio where cedulaPersona = '$eliminarId'");
		$result =  mysql_query ("select idVehiculo from traspaso where cedulaPersona = '$eliminarId' AND listaTraspaso = '0'");
		while ($result1 = mysql_fetch_assoc($result)){
		$idVehiculo = $result1['idVehiculo'];
		mysql_query("delete from traspaso where cedulaPersona = '$eliminarId' AND idVehiculo='$idVehiculo' AND listaTraspaso = '0'");
		mysql_query("delete from Vehiculo where idVehiculo = '$idVehiculo'");
		mysql_query("delete from inscripcion where cedulaPersona = '$eliminarId'");
		}
	}
	if($cedula!=NULL)
	{
			
			
			$result =  mysql_query ("SELECT * FROM persona P, socio S WHERE S.cedulaPersona = '$cedula' AND S.cedulaPersona = P.cedulaPersona ");
			
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
				<td align="center"><a href="../php/eliminarSocio.php?id='.$result2['cedulaPersona'].'">Eliminar</a></td>
				</tr>';	 
			
			}
			else
			{	
					$pnlcontent->add("mensaje","No ha sido registrado un socio con esa cedula.");	
			}
	}
	
	
	$result =  mysql_query ("SELECT * FROM persona P, socio S WHERE S.cedulaPersona = P.cedulaPersona ",$conexion);
	
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
				<td align="center"><a href="../php/eliminarSocio.php?id='.$result1['cedulaPersona'].'">Eliminar</a></td>
				</tr>';
				
	}//while
		$pnlcontent->add("informacion2",$informacion2);								
		$pnlcontent->add("informacion",$informacion);								
										
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);

	$pnlmain->show();
	
	
?>