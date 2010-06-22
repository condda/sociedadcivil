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
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	
	extract($_POST);
	$pnlcontent = new Panel("../html/fConsultarBeneficiario.html");
	
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
	 else if ($consultarCedula){
		$result = mysql_query("select * from Beneficiario where cedulaBeneficiario = '$consultarCedula'");
		$result1 = mysql_fetch_assoc($result);	
		$result2 = mysql_query("select distinct 
							   Persona.nombrePersona,
							   Persona.apellidoPersona
							   from Beneficiario,Socio_Beneficiario,Avance_Beneficiario,Persona 
							   where ((Socio_Beneficiario.cedulaBeneficiario='$consultarCedula' and
									   Socio_Beneficiario.cedulaPersona=Persona.cedulaPersona) or  
									  (Avance_Beneficiario.cedulaBeneficiario='$consultarCedula' and
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
		$result = mysql_query("select * from Socio_Beneficiario where cedulaBeneficiario = '$consultarCedula'");
		$result1 = mysql_fetch_assoc($result);	
		if($result1)
			$pnlcontent->add("tipo","Socio");					
		else
			$pnlcontent->add("tipo","Avance");					
	}
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>