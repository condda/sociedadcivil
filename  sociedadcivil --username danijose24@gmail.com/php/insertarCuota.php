<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	 $cedulaPersona = $_REQUEST['phpCedulaPersona'];
	 $montoPago = $_REQUEST['phpMontoPago'];
	 $idCuota = $_REQUEST['phpIdCuota'];
	 $idNorma = $_REQUEST['phpIdNorma'];
	 

	 
	 $result = mysql_query ("select numeroMesCuota, tipoCuota from cuota where idCuota = '$idCuota'");
	 $result1 = mysql_fetch_assoc($result);
	 
	$mesCuota = $result1['numeroMesCuota'];
	
	$tipoCuota = $result1['tipoCuota'];
	 if ($mesCuota<10)
	 $fechaCuota = $ano."-0".$mesCuota."-01";
	 else
	 $fechaCuota = $ano."-".$mesCuota."-01";
	$diasTranscurridos = floor(abs(strtotime($date1) - strtotime($fechaCuota))/86400);
	 
	 if (($diasTranscurridos>60)&&($tipoCuota == 1)){
		 
		 $result = mysql_query ("select nombrePersona, apellidoPersona from persona where cedulaPersona = '$cedulaPersona'");
		 $result1 = mysql_fetch_assoc($result);
		 $nombrePersona = $result1['nombrePersona'];
		 $apellidoPersona = $result1['apellidoPersona'];
		 
		 echo 'Importante<br>';
		 echo $nombrePersona." ".$apellidoPersona.' debe ser sancionado por no pagar la cuota ordinaria al mes subsiguiente<br>';
		 
	 }
	 
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
		
		$result = mysql_query ("select idCuotaSocio from cuota_socio where cedulaPersona = '$cedulaPersona' order by idCuotaSocio desc limit 1");
		$result1 = mysql_fetch_assoc($result);
		
		$idCuotaSocio = $result1['idCuotaSocio'];

		
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
											 idCuotaSocio) 
											 values (
													 '$montoNorma',
													 '$date1',
													 '$idNorma',
													 '$idCuotaSocio'
													 )");
											
			$result = mysql_query ("select * from multa where idNorma = '$idNorma' AND idCuotaSocio = '$idCuotaSocio' order by idMulta desc limit 1");
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
		
		
		$result = mysql_query ("select idCuotaAvance from cuota_avance where cedulaPersona = '$cedulaPersona' order by idCuotaAvance desc limit 1");
		$result1 = mysql_fetch_assoc($result);
		
		$idCuotaAvance = $result1['idCuotaAvance'];
		
		
		if ($idNorma){
		
			$result = mysql_query ("select * from norma where idNorma = '$idNorma'");
			$result1 = mysql_fetch_assoc($result);
			
			$montoNorma = $result1['montoNorma'];
			
			mysql_query ("insert into multa (montoMulta,
											 fechaMulta,
											 idNorma,
											 idCuotaAvance) 
											 values (
													 '$montoNorma',
													 '$date1',
													 '$idNorma',
													 '$idCuotaAvance'
													 )");
											
			$result = mysql_query ("select * from multa where idNorma = '$idNorma' AND idCuotaAvance = '$idCuotaAvance' order by idMulta desc limit 1");
			$result1 = mysql_fetch_assoc($result);
			
			$idMulta = $result1['idMulta'];					
			mysql_query ("insert into ingreso (tipoIngreso,idMulta)
											   values ('1',
													   '$idMulta')");
		
		}
		
	//PREGUNTAR SI HAY QUE AGREGAR SANCION AL NO PAGAR A TIEMPO
	//REVISAR LAS NORMAS Y HACER LAS VALIDACIONES NECESARIAS
	
		
	
	}
	
	echo "Se ha registrado su pago con existo.";
	include "../db/cerrar_conexion.php";
?>
	