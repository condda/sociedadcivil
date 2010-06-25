<?php

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$fechaI =$_REQUEST['phpFechaI'];
	$fechaF =$_REQUEST['phpFechaF'];
	
	$result = mysql_query ("select HC.idHistCargo, HC.fechaCargo, HC.cedulaPersona, JD.nombreJuntadirectiva, P.nombrePersona, P.apellidoPersona from hist_cargo HC, persona P, juntadirectiva JD where HC.fechaCargo between '$fechaI' and '$fechaF' AND HC.idJuntadirectiva = JD.idJuntadirectiva and HC.cedulaPersona = P.cedulaPersona order by HC.fechaCargo ");
	
	if ($result1 = mysql_fetch_assoc($result)){
		
		
		echo '<tr><td align="center"><strong>Fecha</strong></td><td width="150" align="center"><strong>Cedula Persona</strong></td><td width="60" align="center"><strong>Nombre</strong></td><td width="90" align="center"><strong> Apellido</strong></td><td width="190" align="center"><strong>Cargo</strong></td><td width="190" align="center"><strong>Cargo Opcional</strong></td></tr>';
		
	}
	else
	echo "No se encontro una Junta directiva entre esas fechas";
	
	while ($result1){
		$idHistCargo = $result1['idHistCargo'];
		
		$result2 = mysql_query("select JD.nombreJuntadirectiva from juntadirectiva JD, hist_cargo HC where HC.idHistCargo = '$idHistCargo' AND HC.idJuntadirectivaOpcional = JD.idJuntadirectiva");
		$result3 = mysql_fetch_assoc($result2);
		
		
		echo '<tr><td align="center">'.$result1['fechaCargo'].'</td><td width="150" align="center">'.$result1['cedulaPersona'].'</td><td width="60" align="center">'.$result1['nombrePersona'].'</td><td width="90" align="center">'.$result1['apellidoPersona'].'</td><td width="190" align="center">'.$result1['nombreJuntadirectiva'].'</td><td width="190" align="center">'.$result3['nombreJuntadirectiva'].'</td><td width="50" align="center"><a href="#" onclick="eliminarHistCargo('.$idHistCargo.')">Eliminar</a></td></tr>';
		
		$result1 = mysql_fetch_assoc($result);
	}
	
	
	
	include "../db/cerrar_conexion.php";
?>