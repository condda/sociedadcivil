<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$cedulaPersona = $_REQUEST['phpCedulaPersona'];
	$fondo = $_REQUEST['phpfondo'];

	
	$result = mysql_query("select P.nombrePersona, P.apellidoPersona FROM  persona P, socio S where S.cedulaPersona = '$cedulaPersona' AND S.cedulaPersona = P.cedulaPersona");
	
	if($result1 = mysql_fetch_assoc($result)){
		$tipoPersona = 1;

	}
	else{
	
		$result = mysql_query("select P.nombrePersona, P.apellidoPersona FROM  persona P, avance A where A.cedulaPersona = '$cedulaPersona' AND A.cedulaPersona = P.cedulaPersona");		
		
		if ($result1 = mysql_fetch_assoc($result)){
			$tipoPersona = 2;		
		}
		else{
			echo "No se encuentra la persona en nuestra base de datos";
			$tipoPersona = 0;	
		}

		
	}
	
	if ($tipoPersona != 0){
		
		$nombrePersona = $result1['nombrePersona'];
		$apellidoPersona = $result1['apellidoPersona'];
		
	
		echo '<strong>Nombre: </strong>'.$nombrePersona.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<strong>Apellido: </strong>'.$apellidoPersona.'<br>';
		
		if ($tipoPersona == 1)
		$result = mysql_query ("select FS.montoFondoSocio, FS.fechaFondoSocio from fondo_socio FS, fondo F where FS.cedulaPersona = '$cedulaPersona' AND FS.idFondo = F.idFondo");
		$result1 = mysql_fetch_assoc($result);
		if (!$result1){
		echo "No hay pagos a este fondo extraordinario en nuestra base de datos";
		}
		else{
		$montoFondo	= $result1['montoFondoSocio'];
		$fechaFondo	= $result1['fechaFondoSocio'];
		echo '<strong>Fecha: </strong>'.$fechaFondo.'<br>';
		echo '<strong>Monto: </strong>'.$montoFondo.'<br>';
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="Continuar" align="middle" onclick="datosCuotaE()" /><input type="hidden" name="tipoPersona" id="tipoPersona" value="'.$tipoPersona.'"/>';
			
		}

		
	}
	
		
	
		
	include "../db/cerrar_conexion.php";
?>
	