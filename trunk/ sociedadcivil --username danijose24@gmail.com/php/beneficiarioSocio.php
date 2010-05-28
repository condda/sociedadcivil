<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	
	$pnlcontent = new Panel ("../html/beneficiario.html");

	
	$pnlcontent->add("mensaje",$mensajeError);	
		
	$mensajeError = "Ya existe un beneficiario con ese numero de cedula!!!.";
	
	$pnlmenu->add("activo1",'id="active"');
	
	$pnlmain->add("menu",$pnlmenu);
	
	
	$nombreBeneficiario   = $_REQUEST['nombre'];
	$apellidoBeneficiario = $_REQUEST['apellido'];
	$cedulaBeneficiario   = $_REQUEST['cedula'];
	$cedulaPersona = $_REQUEST['cedulaPersona'];
	$pnlcontent->add("campoOcultoCedulaPersona",$cedulaPersona);	
	
	$tipo = 1;

	$pnlcontent->add("tipo",$tipo);
	//	$pnlcontent->add("mensaje","Click en Finalizar Inscripcion para salir, para ingresar nuevo beneficiario Click en Inscribir Beneficiario.");
if($cedulaBeneficiario)
{		
					
			$result =  mysql_query ("SELECT cedulaBeneficiario FROM beneficiario WHERE cedulaBeneficiario = '$cedulaBeneficiario'");


		if (!$result1 = mysql_fetch_assoc($result))
		{			
	
			mysql_query (" INSERT INTO beneficiario (
													 cedulaBeneficiario,
													 nombreBeneficiario,
													 apellidoBeneficiario
													 )
						 VALUES (
								 '$cedulaBeneficiario',
								 '$nombreBeneficiario',
								 '$apellidoBeneficiario'
								 )");
			
			
			
		}// else 1
		
		
		mysql_query (" INSERT INTO socio_beneficiario (
													 cedulaPersona,
													 cedulaBeneficiario
													 )
						 VALUES (
								 '$cedulaPersona',
								 '$cedulaBeneficiario'
								 )");
		
	
}


    $pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	
	
?>