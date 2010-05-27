<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	
	$pnlcontent = new Panel ("../html/crearSocio.html");	
	$tipo = 1;

	$pnlcontent->add("tipo",$tipo);
	
	$mensajeError = "Ya existe un usuario con ese numero de cedula!!!.";
	$mensajeErrorDatos = "Faltan campos por llenar.";
	
	$cedulaPersona = $_REQUEST['cedula'];
	$nombrePersona = $_REQUEST['nombre'];
	$apellidoPersona = $_REQUEST['apellido'];
	$fecha_nacimientoPersona = $_REQUEST['fecha_nacimiento'];
	$sexoPersona = $_REQUEST['sexo'];
	$nacionalidadPersona = $_REQUEST['nacionalidad'];
	$direccionPersona = $_REQUEST['direccion'];
	$telefonoPersona = $_REQUEST['telefono'];
	$fecha_licenciaPersona = $_REQUEST['fecha_licencia'];
	$estado_civilPersona = $_REQUEST['estado_civil'];
	$nombre_conyuguePersona = $_REQUEST['nombre_conyugue'];
	
	
	
	
	
	
	
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
											   estadoCPersona, 
											   nombreCPersona,
											   idSociedad)
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
								 '$nombre_conyuguePersona',
								 '1')");
			
			mysql_query ("INSERT INTO socio (
											 cedulaPersona
											 )
						 VALUES				 (
											  '$cedulaPersona'
											  )");
		
												
						if ($beneficiario==1)
						{
							
							$pnlcontent = new Panel ("../html/beneficiario.html");
							$pnlcontent->add("campoOcultoCedulaPersona",$cedulaPersona);
						
						}
						if ($beneficiario==2)
						{
							$pnlcontent = new Panel ("../html/vehiculoSocio.html");
						}
						
						
		
		
			
	} // ELSE 1	
	
		
		
    $pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);


	$pnlmain->show();
	
	
?>