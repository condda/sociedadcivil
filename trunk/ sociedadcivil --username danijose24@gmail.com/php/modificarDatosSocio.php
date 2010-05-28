<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
		$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');

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
	
	
	

	
	
	

		
			if(!($nombre_conyugue))
			{//IF 2
				$nombre_conyugue = NULL; 
			}//IF 2
			
	
		// IF 3
		
		// ELSE 1
		
		if($cedula)
		{
			// pnlcontent->add("mensaje","AAAAAAAAAAAAAAAAAAAAAA");
			//UPDATE persona SET nombrePersona =  'cermeno',
//apellidoPersona =  'salcedo' WHERE cedulaPersona =  '18933251'
			
			mysql_query ("UPDATE persona SET  											  
											   nombrePersona = '$nombrePersona', 
											   apellidoPersona = '$apellidoPersona', 
											   fechaNPersona = '$fecha_nacimientoPersona', 
											   sexoPersona = '$sexoPersona', 
											   nacionalidadPersona = '$nacionalidadPersona', 
											   direccionPersona = '$direccionPersona', 
											   telefonoPersona = '$telefonoPersona', 
											   fechaLPersona = '$fecha_licenciaPersona', 
											   estadoCPersona = '$estado_civilPersona', 
											   nombreCPersona = '$nombre_conyuguePersona'
											   WHERE (cedulaPersona = '$cedulaPersona')");		
		
												
				/*		if ($beneficiario==1)
						{
							
							$pnlcontent = new Panel ("../html/beneficiario.html");
						
						}
						if ($beneficiario==2)
						{
							$pnlcontent = new Panel ("../html/vehiculoSocio.html");
						}
						*/
						
		
		
		}
	 // ELSE 1	
	
		
		header ("Location: ../classes/Site.php");
  /*  $pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);


	$pnlmain->show();
	*/
	
?>