<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/modificarSocio.html");
	$pnlmenu->add("activo1",'id="active"');
	
	$cedula = $_REQUEST['cedula'];
	$modificar = $_REQUEST['modificacion'];
	

	
if($cedula!=NULL)
	{
			
			
			$result =  mysql_query ("SELECT * FROM persona WHERE cedulaPersona = '$cedula' ");
			
			if ($result2 = mysql_fetch_assoc($result))
			{	
				$informacion2 = $informacion2.'<tr>
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
			if($modificar == 1)
			{
				$pnlcontent = new Panel ("../html/modificarDatosSocio.html");
				$pnlcontent->add("cedula",'<input type="text" name="cedula" id="cedula" readonly value="'.$cedula.'">');
				
			}
	}
	
	
	$result =  mysql_query ("SELECT * FROM persona");
	
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