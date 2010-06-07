<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');

	
	$pnlcontent = new Panel ("../html/buscarAvance.html");
	$pnlmenu->add("activo1",'id="active"');
	
	$cedula = $_REQUEST['cedula'];
	

	
if($cedula!=NULL)
	{
			
			
			$result =  mysql_query ("SELECT * FROM persona P, avance A WHERE A.cedulaPersona = '$cedula' AND A.cedulaPersona = P.cedulaPersona ");
			
			if ($result2 = mysql_fetch_assoc($result))
			{	
				$informacion2 = 	$informacion2.'<tr>
				<td>'.$result2['cedulaPersona'].'</td>
				<td>'.$result2['nombrePersona'].'</td>
				<td>'.$result2['apellidoPersona'].'</td>
				<td>'.$result2['telefonoPersona'].'</td>
				<td>'.$result2['direccionPersona'].'</td>
				<td>'.$result2['nacionalidadPersona'].'</td>
				<td>'.$result2['sexoPersona'].'</td>
				<td>'.$result2['fechaNPersona'].'</td>
				<td>'.$result2['estadoCPersona'].'</td>
				<td>'.$result2['fechaLPersona'].'</td>
				<td>'.$result2['nombreCPersona'].'</td>
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
				<td>'.$result1['cedulaPersona'].'</td>
				<td>'.$result1['nombrePersona'].'</td>
				<td>'.$result1['apellidoPersona'].'</td>
				<td>'.$result1['telefonoPersona'].'</td>
				<td>'.$result1['direccionPersona'].'</td>
				<td>'.$result1['nacionalidadPersona'].'</td>
				<td>'.$result1['sexoPersona'].'</td>
				<td>'.$result1['fechaNPersona'].'</td>
				<td>'.$result1['estadoCPersona'].'</td>
				<td>'.$result1['fechaLPersona'].'</td>
				<td>'.$result1['nombreCPersona'].'</td>
				</tr>';
				
	}//while
		$pnlcontent->add("informacion2",$informacion2);								
		$pnlcontent->add("informacion",$informacion);								
										
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	
	
?>