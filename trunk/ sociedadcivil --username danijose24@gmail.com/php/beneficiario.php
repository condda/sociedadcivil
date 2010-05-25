<?php
	

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/beneficiario.html");
	
	
	$pnlcontent->add("mensaje",$mensajeError);	
		
	$mensajeError = "Ya existe un beneficiario con ese numero de cedula!!!.";
	
	$pnlmenu->add("activo1",'id="active"');
	
	$pnlmain->add("menu",$pnlmenu);
	
	
	$nombreBeneficiario   = $_REQUEST['nombre'];
	$apellidoBeneficiario = $_REQUEST['apellido'];
	$cedulaBeneficiario   = $_REQUEST['cedula'];
	

	
	//	$pnlcontent->add("mensaje","Click en Finalizar Inscripcion para salir, para ingresar nuevo beneficiario Click en Inscribir Beneficiario.");
if($cedulaBeneficiario)
{		
					
			$result =  mysql_query ("SELECT cedulaBeneficiario FROM benificiario WHERE cedulaBeneficiario = '$cedulaBeneficiario'");


		if ($result1 = mysql_fetch_assoc($result))
		{//IF 1
			
		
			$pnlcontent->add("mensaje",$mensajeError);			
			
			
		}// IF 1
		
		else
		{// else 1			
	
			mysql_query (" INSERT INTO benificiario (
													 cedulaBeneficiario,
													 nombreBeneficiario,
													 apellidoBeneficiario
													 )
						 VALUES (
								 '$cedulaBeneficiario',
								 '$nombreBeneficiario',
								 '$apellidoBeneficiario'
								 )");
			
				mysql_query (" INSERT INTO socio_beneficiario (
													 cedulaBeneficiario													 
													 )
						 VALUES (
								 '$cedulaBeneficiario'
								 )");
		
			
			
		}// else 1
	
}


    $pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	
	
?>