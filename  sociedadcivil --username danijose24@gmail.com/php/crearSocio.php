<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/crearSocio.html");	
	
	$mensajeError = "Ya existe un usuario con ese numero de cedula!!!.";
	$mensajeErrorDatos = "Faltan campos por llenar.";
	
	$nombrePersona = $_REQUEST['nombre'];
	$apellidoPersona = $_REQUEST['apellido'];
	$cedulaPersona = $_REQUEST['cedula'];
	$nombre_conyuguePersona = $_REQUEST['nombre_conyugue'];
	$direccionPersona = $_REQUEST['direccion'];
	$nacionalidadPersona = $_REQUEST['nacionalidad'];
	$telefonoPersona = $_REQUEST['telefono'];
	$estado_civilPersona = $_REQUEST['estado_civil'];
	$fecha_licenciaPersona = $_REQUEST['fecha_licencia'];
	$fecha_nacimientoPersona = $_REQUEST['fecha_nacimiento'];
	$sexoPersona = $_REQUEST['sexo'];
	$beneficiario = $_REQUEST['beneficiario'];
	
	
	
	$pnlmenu->add("activo1",'id="active"');
	
	
	
	if(($nombrePersona) && ($apellidoPersona) && ($cedulaPersona) && ($telefonoPersona) && ($direccionPersona) && ($fecha_nacimientoPersona) && ($fecha_licenciaPersona) && ($estado_civilPersona!=0) && ($nacionalidadPersona)&& ($sexoPersona!=0) && 
	($beneficiario!=0)){
		
		if(!($nombre_conyugue)){
			$nombre_conyugue = NULL; }
			
	
		$result =  mysql_query ("SELECT cedulaPersona FROM persona WHERE cedulaPersona = '$cedulaPersona'");
		
		if ($result1= mysql_fetch_assoc($result)){
			
			$pnlcontent->add("mensaje",$mensajeError);
			
			
			
		}
		else
		{
			mysql_query ("INSERT INTO persona (
											   cedulaPersona,
											   nombrePersona, 
											   apellidoPersona, 
											   fechaNPersona, 
											   sexoPersona, 
											   nacionalidadPersona, 
											   direccionPersona, 
											   telefonoPersona, 
											   fechaLpersona, 
											   estadoCpersona, 
											   nombreCpersona )
						 VALUES (
								 '$cedulaPersona',
								 '$nombrePersona', 				 
								 '$apellidoPersona',
								 '$fecha_nacimientoPersona',
								 '$sexoPersona',
								 '$nacionalidadPersona',
								 '$direccionPersona',
								 '$telefonoPersona',
								 '$fecha_licenciaPersona',
								 '$estado_civilPersona',
								 '$nombre_conyuguePersona'
								 )");																																																	   	
		if($beneficiario==1)
		{
			$pnlmain = new Panel ("../html/main.html");	
			$pnlmenu = new Panel("../html/menu.html");
			$pnlcontent = new Panel ("../html/beneficiario.html");			
		}
			
		$pnlmain = new Panel ("../html/main.html");	
		$pnlmain->add("nombre","Socio");	
		$pnlmain->add("mensaje","El socio se registro con Exito");	
		}
		
		
	}
	
	
	
		
		
		$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);

	$pnlmain->show();
	
	
?>