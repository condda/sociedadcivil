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
	
	
	

		
			if(!($nombre_conyugue))
			{//IF 2
				$nombre_conyugue = NULL; 
			}//IF 2
			
	
		$result =  mysql_query ("SELECT cedulaPersona FROM persona WHERE cedulaPersona = '$cedulaPersona'");
		
		if ($result1= mysql_fetch_assoc($result))
		{//IF 3
			
			if($cedulaPersona)
			$pnlcontent->add("mensaje",$mensajeError);			
			
			
		}// IF 3
		else
		{// ELSE 1
		
			
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
			
			mysql_query ("INSERT INTO socio (
											 cedulaPersona
											 )
						 VALUES				 (
											  '$cedulaPersona'
											  )");
		
												
						if ($beneficiario==1)
						{
							
							$pnlcontent = new Panel ("../html/beneficiario.html");
						
						}
						else
						{
							$pnlcontent = new Panel ("../html/vehiculoSocio.html");
						}
						
						
		
		
			
	} // ELSE 1
			
	
		

	
	
	
		
		
    $pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);


	$pnlmain->show();
	
	
?>