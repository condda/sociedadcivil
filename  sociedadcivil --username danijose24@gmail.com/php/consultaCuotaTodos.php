<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$tipoCuota = $_REQUEST['phpTipoCuota'];
	$fechaI = $_REQUEST['phpFechaI'];
	$fechaF = $_REQUEST['phpFechaF'];
	
	
echo '<br><tr><td width="90" align="center"><strong>Fecha Pago</strong></td><td width="90" align="center"><strong>Monto</strong></td><td width="170" align="center"><strong>Mes Correspondiente</strong></td><td  width="130" align="center"><strong>Nombre</strong></td><td width="130" align="center"><strong>Apellido</strong></td></tr>';
	
	$result = mysql_query ("select * from cuota_socio CS, cuota C, persona P where CS.fechaCuota between '$fechaI' and '$fechaF' and C.tipoCuota = '$tipoCuota' and C.idCuota = CS.idCuota and CS.cedulaPersona = P.cedulaPersona");

	
	while ($result1 = mysql_fetch_assoc($result)){
		echo '<tr><td width="90" align="center">'.$result1['fechaCuota'].'</td><td width="90" align="center">'.$result1['montoCuotaSocio'].'</td><td width="90" align="center">'.$result1['mesCuota'].'</td><td width="90" align="center">'.$result1['nombrePersona'].'</td><td width="90" align="center">'.$result1['apellidoPersona'].'</td></tr>';
	
	
	}
	$result = mysql_query ("select * from cuota_avance CA ,cuota C, persona P where C.tipoCuota = '$tipoCuota' and C.idCuota = CA.idCuota and CA.cedulaPersona = P.cedulaPersona");

	
	while ($result1 = mysql_fetch_assoc($result)){
		echo '<tr><td width="90" align="center">'.$result1['fechaCuota'].'</td><td width="90" align="center">'.$result1['montoCuotaSocio'].'</td><td width="90" align="center">'.$result1['mesCuota'].'</td><td width="90" align="center">'.$result1['nombrePersona'].'</td><td width="90" align="center">'.$result1['apellidoPersona'].'</td></tr>';
	
	
	}
	
	include "../db/cerrar_conexion.php";
?>