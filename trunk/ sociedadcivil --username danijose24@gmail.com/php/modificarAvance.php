<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');

	$pnlcontent = new Panel ("../html/modificarAvance.html");
	$pnlmenu->add("activo1",'id="active"');
	
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	
	$cedula = $_REQUEST['cedula'];
	$modificar = $_REQUEST['modificacion'];
	

	
if($cedula!=NULL)
	{
			
			
			$result =  mysql_query ("SELECT * FROM persona P, avance A WHERE A.cedulaPersona = '$cedula' AND A.cedulaPersona = P.cedulaPersona");
			
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
				$pnlcontent->add("nombre",$result2['nombrePersona']);
				$pnlcontent->add("apellido",$result2['apellidoPersona']);
				$pnlcontent->add("direccion",$result2['direccionPersona']);
				$pnlcontent->add("fecha_nacimiento",$result2['fechaNPersona']);
				$pnlcontent->add("telefono",$result2['telefonoPersona']);
				$pnlcontent->add("nacionalidad",$result2['nacionalidadPersona']);
				$pnlcontent->add("fecha_licencia",$result2['fechaLPersona']);
				$pnlcontent->add("nombre_conyugue",$result2['nombreCPersona']);
				
				if (($result2['estadoCPersona']) == "Soltero") 			$pnlcontent->add("selectSoltero",'selected="selected"');
				else if (($result2['estadoCPersona']) == "Casado") 		$pnlcontent->add("selectCasado",'selected="selected"');
				else if (($result2['estadoCPersona']) == "Viudo") 		$pnlcontent->add("selectViudo",'selected="selected"');
				else if (($result2['estadoCPersona']) == "Divorciado")  $pnlcontent->add("selectDivorciado",'selected="selected"');
				
				if (($result2['sexoPersona']) == "F") $pnlcontent->add("selectFemenino",'selected="selected"');
				else if (($result2['sexoPersona']) == "M") $pnlcontent->add("selectMasculino",'selected="selected"');
				
				$result =  mysql_query ("SELECT * FROM beneficiario B, Avance_Beneficiario AF WHERE AF.cedulaPersona = '$cedula' AND AF.cedulaBeneficiario = B.cedulaBeneficiario");
				$result1 = mysql_fetch_assoc($result);
				if ($result1){
					$pnlcontent->add("selectSi",'selected="selected"');
				}
				else
				$pnlcontent->add("selectNo",'selected="selected"');


				
			}
	}
	
	
	$result =  mysql_query ("SELECT * FROM persona P, avance A where A.cedulaPersona = P.cedulaPersona ");
	
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