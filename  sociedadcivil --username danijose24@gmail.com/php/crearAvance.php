<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');

	$pnlcontent = new Panel ("../html/crearAvance.html");	
	
	
	$mensajeError = "Ya existe un usuario con ese numero de cedula!!!.";
	$mensajeErrorDatos = "Faltan campos por llenar.";
	
	
	
	$cedulaPersona = $_REQUEST['cedula'];
	$nombrePersona = $_REQUEST['nombre'];
	$apellidoPersona = $_REQUEST['apellido'];
	$nombre_conyuguePersona = $_REQUEST['nombre_conyugue'];
	$direccionPersona = $_REQUEST['direccion'];
	$fecha_nacimientoPersona = $_REQUEST['fecha_nacimiento'];
	$sexoPersona = $_REQUEST['sexo'];
	$nacionalidadPersona = $_REQUEST['nacionalidad'];
	$telefonoPersona = $_REQUEST['telefono'];
	$estado_civilPersona = $_REQUEST['estado_civil'];
	$fecha_licenciaPersona = $_REQUEST['fecha_licencia'];
	$beneficiario = $_REQUEST['beneficiario'];
	$monto = $_REQUEST['monto'];
	
	
	
	$tipo = 2;
	$pnlcontent->add("tipo",$tipo);			
	
	$pnlmenu->add("activo1",'id="active"');
	
	
	
if ($cedulaPersona){
		
			if(!($nombre_conyugue))
			{//IF 2
				$nombre_conyugue = NULL; 
			}//IF 2
			
	
		$result =  mysql_query ("SELECT cedulaPersona FROM persona WHERE cedulaPersona = '$cedulaPersona'");
		
		if (!$result1= mysql_fetch_assoc($result))
		{//IF 3
			
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
			
			mysql_query ("INSERT INTO avance (
											 cedulaPersona
											 )
						 VALUES				 (
											  '$cedulaPersona'
											  )");
			
			
		}// IF 3
		else
		{// ELSE 1
		

		
			mysql_query ("INSERT INTO avance (
											 cedulaPersona
											 )
						 VALUES				 (
											  '$cedulaPersona'
											  )");
			
						
		
		
			
		}// ELSE 1
			
	
		

	mysql_query ("INSERT INTO inscripcion (
											 idInscripcion,
											 fechaInscripcion,
											 estatusInscripcion,
											 fechaAInscripcion,
											 montoInscripcion,
											 tipoInscripcion,
											 cedulaPersona											
											 )
						 VALUES				 (
											  'NULL',
											  '$date1',
											  '4',
											  '0000-00-00',
											  '$monto',
											  '2',
											  '$cedulaPersona'
											  )");
			
			
		$result =  mysql_query ("SELECT idInscripcion FROM inscripcion WHERE cedulaPersona = '$cedulaPersona' order by idInscripcion desc limit 1");
		$result1= mysql_fetch_assoc($result);
		$idInscripcion = $result1['idInscripcion'];
				
				
				mysql_query ("INSERT INTO ingreso (	
											 tipoIngreso, 
											 idInscripcion
											 )
						 VALUES				 (
											
											  '4',
											  '$idInscripcion'
											  )");
		
												
						if ($beneficiario==1)
						{
							
							$pnlcontent = new Panel ("../html/beneficiarioAvance.html");
							$pnlcontent->add("tipo",$tipo);		
							$pnlcontent->add("campoOcultoCedulaPersona",$cedulaPersona);		
						
						}
						else
						{
							$pnlcontent = new Panel ("../html/vehiculoAvance.html");
						}
						
	
	
}
		
    $pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);


	$pnlmain->show();
	
	
?>