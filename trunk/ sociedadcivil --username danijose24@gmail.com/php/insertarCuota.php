<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	 $cedulaPersona = $_REQUEST['phpCedulaPersona'];
	 $montoPago = $_REQUEST['phpMontoPago'];
	 $idCuota = $_REQUEST['phpIdCuota'];
	 $idNorma = $_REQUEST['phpIdNorma'];
	

	$result = mysql_query ("select * from socio where cedulaPersona = '$cedulaPersona'");
	
	if (!$result1 = mysql_fetch_assoc($result)){
		$tipoPersona = 2;
	}
	else
			$tipoPersona = 1;
	
	
	
		if ($tipoPersona == 1){
		mysql_query ("insert into cuota_socio (cedulaPersona,idCuota,fechaCuota,montoCuotaSocio)
											   values ('$cedulaPersona',
													   '$idCuota',
													   '$date1',
													   '$montoPago')");
		

		
		mysql_query ("INSERT INTO ingreso (	
											tipoIngreso, 
											 cedulaSocio)
						 VALUES				 (
											
											  '2',
											  '$cedulaPersona'
											  )");
		
		
		if ($idNorma){
		
			$result = mysql_query ("select * from norma where idNorma = '$idNorma'");
			$result1 = mysql_fetch_assoc($result);
			
			 $montoNorma = $result1['montoNorma'];
			 $idNorma;
			mysql_query ("insert into multa (montoMulta,
											 fechaMulta,
											 idNorma,
											 cedulaPersonaS) 
											 values (
													 '$montoNorma',
													 '$date1',
													 '$idNorma',
													 '$cedulaPersona'
													 )");
											
			$result = mysql_query ("select * from multa where idNorma = '$idNorma' AND cedulaPersonaS = '$cedulaPersona' order by idMulta desc limit 1");
			$result1 = mysql_fetch_assoc($result);
			
			$idMulta = $result1['idMulta'];					
			mysql_query ("insert into ingreso (tipoIngreso,idMulta)
											   values ('1',
													   '$idMulta')");
		
		}
		
	//PREGUNTAR SI HAY QUE AGREGAR SANCION AL NO PAGAR A TIEMPO
	//REVISAR LAS NORMAS Y HACER LAS VALIDACIONES NECESARIAS
	
		
	
	}
	
	
	
	if ($tipoPersona == 2){
		mysql_query ("insert into cuota_avance (cedulaPersona,idCuota,fechaCuota,montoCuotaAvance)
											   values ('$cedulaPersona',
													   '$idCuota',
													   '$date1',
													   '$montoPago')");
		
		$result = mysql_query ("select * from cuota_avance order by cedulaPersona desc limit 1");
		$result1 = mysql_fetch_assoc($result);
		
		mysql_query ("insert into ingreso (tipoIngreso,idCuotaAvance)
											   values ('2',
													   '$cedulaPersona')");
		
		
		if ($idNorma){
		
			$result = mysql_query ("select * from norma where idNorma = '$idNorma'");
			$result1 = mysql_fetch_assoc($result);
			
			$montoNorma = $result1['montoNorma'];
			
			mysql_query ("insert into multa (montoMulta,
											 fechaMulta,
											 idNorma,
											 cedulaPersonaA) 
											 values (
													 '$montoNorma',
													 '$date1',
													 '$idNorma',
													 '$cedulaPersona'
													 )");
											
			$result = mysql_query ("select * from multa where idNorma = '$idNorma' AND cedulaPersonaA = '$cedulaPersona' order by idMulta desc limit 1");
			$result1 = mysql_fetch_assoc($result);
			
			$idMulta = $result1['idMulta'];					
			mysql_query ("insert into ingreso (tipoIngreso,idMulta)
											   values ('1',
													   '$idMulta')");
		
		}
		
	//PREGUNTAR SI HAY QUE AGREGAR SANCION AL NO PAGAR A TIEMPO
	//REVISAR LAS NORMAS Y HACER LAS VALIDACIONES NECESARIAS
	
		
	
	}
	
	
	include "../db/cerrar_conexion.php";
?>
	