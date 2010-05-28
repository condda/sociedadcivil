<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlcontent = new Panel("../html/modificarBeneficiario.html");
	
	$modificarCedula = $_REQUEST['modificarCedula'];
	if ($modificarCedula){
		$result = mysql_query("select * from Beneficiario where cedulaBeneficiario = '$modificarCedula'");
		$result1 = mysql_fetch_assoc($result);
		if (!$result1){
			$pnlcontent->add("mensaje","Este Beneficiario no existe dentro de la Sociedad!");
			$pnlcontent->add("modificarCedula",$modificarCedula);					
		}
	}
	else{
		$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		$pnlcontent->add("modificarCedula",$modificarCedula);					
	}

	$result = mysql_query("select distinct Beneficiario.cedulaBeneficiario, 
						   Beneficiario.nombreBeneficiario,
						   Beneficiario.apellidoBeneficiario,
						   Persona.nombrePersona,
						   Persona.apellidoPersona,
						   Persona.cedulaPersona
						   from Beneficiario,Socio_Beneficiario,Avance_Beneficiario,Persona 
						   where ((Beneficiario.cedulaBeneficiario=Socio_Beneficiario.cedulaBeneficiario and
								   Socio_Beneficiario.cedulaPersona=Persona.cedulaPersona) or  
								  (Beneficiario.cedulaBeneficiario=Avance_Beneficiario.cedulaBeneficiario and
								   Avance_Beneficiario.cedulaPersona=Persona.cedulaPersona)) order by Beneficiario.cedulaBeneficiario asc");
	while ($result1 = mysql_fetch_assoc($result)){
		$listaBeneficiario = $listaBeneficiario.
		'<tr><td>'.$result1['cedulaBeneficiario'].'</td>
		<td>'.$result1['nombreBeneficiario'].'</td>
		<td>'.$result1['apellidoBeneficiario'].'</td>
		<td>'.$result1['cedulaPersona'].'</td>
		<td>'.$result1['nombrePersona'].'</td>
		<td>'.$result1['apellidoPersona'].'</td>
		<td><a href="../php/fModificarBeneficiario.php?cedulabeneficiario='.$result1['cedulaBeneficiario'].
		'&cedulapersona='.$result1['cedulaPersona'].'">Modificar</a></td></tr>';
	}
	$pnlcontent->add("modificarBeneficiario",$listaBeneficiario);
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>