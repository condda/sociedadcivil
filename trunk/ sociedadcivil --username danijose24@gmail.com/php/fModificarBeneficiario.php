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
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlcontent = new Panel("../html/fModificarBeneficiario.html");
	
	extract($_POST);
	if (($_REQUEST['cedulabeneficiario']) && ($_REQUEST['cedulapersona'])){
		$cedulabeneficiario =  $_REQUEST['cedulabeneficiario'];
		$cedulapersona =  $_REQUEST['cedulapersona'];
		$result = mysql_query("select * from Beneficiario where cedulaBeneficiario = '$cedulabeneficiario'");
		$result1 = mysql_fetch_assoc($result);	
		$result2 = mysql_query("select * from Persona where cedulaPersona = '$cedulapersona'");
		$result3 = mysql_fetch_assoc($result2);			
		$pnlcontent->add("cedula",$result1['cedulaBeneficiario']);					
		$pnlcontent->add("nombre",$result1['nombreBeneficiario']);					
		$pnlcontent->add("apellido",$result1['apellidoBeneficiario']);
		$pnlcontent->add("soAv",'<option>'.$result3['nombrePersona'].' '.$result3['apellidoPersona'].'</option>');					
		$result = mysql_query("select * from Socio_Beneficiario where cedulaBeneficiario = '$cedulabeneficiario'");
		$result1 = mysql_fetch_assoc($result);	
		if($result1)
			$pnlcontent->add("tipo","Socio");					
		else
			$pnlcontent->add("tipo","Avance");					
	}		
	else if ($modificarCedula){
		$result = mysql_query("select * from Beneficiario where cedulaBeneficiario = '$modificarCedula'");
		$result1 = mysql_fetch_assoc($result);	
		$result2 = mysql_query("select distinct 
							   Persona.nombrePersona,
							   Persona.apellidoPersona
							   from Beneficiario,Socio_Beneficiario,Avance_Beneficiario,Persona 
							   where ((Socio_Beneficiario.cedulaBeneficiario='$modificarCedula' and
									   Socio_Beneficiario.cedulaPersona=Persona.cedulaPersona) or  
									  (Avance_Beneficiario.cedulaBeneficiario='$modificarCedula' and
									   Avance_Beneficiario.cedulaPersona=Persona.cedulaPersona)) order by Persona.cedulaPersona asc");
		$pnlcontent->add("cedula",$result1['cedulaBeneficiario']);					
		$pnlcontent->add("nombre",$result1['nombreBeneficiario']);					
		$pnlcontent->add("apellido",$result1['apellidoBeneficiario']);
		$listaPersonas="";
		while($result3 = mysql_fetch_assoc($result2)){
			extract($result3);
			$listaPersonas = $listaPersonas.'<option>'.$result3['nombrePersona'].' '.$result3['apellidoPersona'].'</option>';
		}
		$pnlcontent->add("soAv",$listaPersonas);					
		$result = mysql_query("select * from Socio_Beneficiario where cedulaBeneficiario = '$modificarCedula'");
		$result1 = mysql_fetch_assoc($result);	
		if($result1)
			$pnlcontent->add("tipo","Socio");					
		else
			$pnlcontent->add("tipo","Avance");					
	}
	else if (($nombre) && ($apellido)){
		mysql_query("update Beneficiario set
		nombreBeneficiario='$nombre',
		apellidoBeneficiario='$apellido' where cedulaBeneficiario='$cedula'");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlmenu->add("activo",'id="active"');
		$pnlmain = new Panel("../html/main.html");
		$pnlmain->add("nombre","Beneficiario");
		$pnlmain->add("mensaje","Fue modificado exitosamente!");
		$pnlcontent = new Panel("../html/contentPrincipal.html");		
	}
	else{
		$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		$pnlcontent->add("nombre",$nombre);					
		$pnlcontent->add("direccion",$direccion);
		$pnlcontent->add("telefono",$telefono);
		$pnlcontent->add("cedRif",$cedRif);
	}		
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>