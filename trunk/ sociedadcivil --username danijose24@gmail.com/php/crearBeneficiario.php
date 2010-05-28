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
	$pnlcontent = new Panel("../html/crearBeneficiario.html");

	extract ($_POST);
	if ($listaSoAv1==1){
		$pnlcontent->add("tipo",'Socio');
		$result = mysql_query("select Socio.cedulaPersona, 
							  Persona.nombrePersona, 
							  Persona.apellidoPersona from Socio,Persona 
							  where Socio.cedulaPersona = Persona.cedulaPersona order by Persona.apellidoPersona asc;");
		while($result1 = mysql_fetch_assoc($result)){
			extract($result1);
			$listaPersonas = $listaPersonas.'<option value="'.$cedulaPersona.'">'.$apellidoPersona.', '.$nombrePersona.'</option>';
		}
		$pnlcontent->add("opcion",$listaPersonas);					
	}
	else if ($listaSoAv1==2){
		$pnlcontent->add("tipo",'Avance');
		$result = mysql_query("select Avance.cedulaPersona, 
							  Persona.nombrePersona, 
							  Persona.apellidoPersona from Avance,Persona 
							  where Avance.cedulaPersona = Persona.cedulaPersona order by Persona.apellidoPersona asc;");
		while($result1 = mysql_fetch_assoc($result)){
			extract($result1);
			$listaPersonas = $listaPersonas.'<option value="'.$cedulaPersona.'">'.$apellidoPersona.', '.$nombrePersona.'</option>';
		}
		$pnlcontent->add("opcion",$listaPersonas);					
	}

	if (($cedula) && ($nombre) && ($apellido) && ($listaSoAv2!=0)){
		$result = mysql_query("select * from Beneficiario where cedulaBeneficiario = '$cedula'");
		$result1 = mysql_fetch_assoc($result);
		if ($result1['cedulaBeneficiario']){
			$pnlcontent->add("mensaje","Este Beneficiario ya existe dentro de la Sociedad!");
			if ($listaSoAv1==1)
				$pnlcontent->add("tipo",'Socio');
			else 
				$pnlcontent->add("tipo",'Avance');
			$pnlcontent->add("cedula",$cedula);					
			$pnlcontent->add("nombre",$nombre);					
			$pnlcontent->add("apellido",$apellido);					
		}
		else {			
			mysql_query("insert into Beneficiario (
			cedulaBeneficiario,
			nombreBeneficiario,
			apellidoBeneficiario) values ('$cedula','$nombre','$apellido')");
			if ($listaSoAv1==1){
				mysql_query("insert into Socio_Beneficiario (
				cedulaPersona,
				cedulaBeneficiario) values ('$listaSoAv2','$cedula')");
			}
			else{
				mysql_query("insert into Avance_Beneficiario (
				cedulaPersona,
				cedulaBeneficiario) values ('$listaSoAv2','$cedula')");
			}
			$pnlmenu = new Panel("../html/menu.html");
			$pnlmenu->add("activo",'id="active"');
			$pnlmain = new Panel("../html/main.html");
			$pnlmain->add("nombre","Beneficiario");
			$pnlmain->add("mensaje","Fue registrado exitosamente!");
			$pnlcontent = new Panel("../html/contentPrincipal.html");		
		}
	}
	else{
		#$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		if ($listaSoAv1==1)
			$pnlcontent->add("tipo",'Socio');
		else 
			$pnlcontent->add("tipo",'Avance');
		$pnlcontent->add("nombre",$nombre);					
		$pnlcontent->add("apellido",$apellido);
		$pnlcontent->add("cedula",$cedula);
	}

		
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>