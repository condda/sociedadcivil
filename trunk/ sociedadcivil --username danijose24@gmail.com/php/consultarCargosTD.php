<?php

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$fechaI =$_REQUEST['phpFechaI'];
	$fechaF =$_REQUEST['phpFechaF'];
	
	$result = mysql_query ("select HC.idHistCargo, HC.fechaCargo, HC.cedulaPersona, TD.nombre, P.nombrePersona, P.apellidoPersona from hist_cargo HC, persona P, tribunald TD where HC.fechaCargo between '$fechaI' and '$fechaF' AND HC.idTribunald = TD.idTribunald and HC.cedulaPersona = P.cedulaPersona order by HC.fechaCargo ");
	
	if ($result1 = mysql_fetch_assoc($result)){
		
		
		echo '<tr><td align="center"><strong>Fecha</strong></td><td width="150" align="center"><strong>Cedula Persona</strong></td><td width="60" align="center"><strong>Nombre</strong></td><td width="90" align="center"><strong> Apellido</strong></td><td width="190" align="center"><strong>Cargo</strong></td></tr>';
		
	}
	else
	echo "No se encontro un Tribunal Disciplinario entre esas fechas";
	
	while ($result1){
		$idHistCargo  = $result1['idHistCargo'];
		
		echo '<tr><td align="center">'.$result1['fechaCargo'].'</td><td width="150" align="center">'.$result1['cedulaPersona'].'</td><td width="60" align="center">'.$result1['nombrePersona'].'</td><td width="90" align="center">'.$result1['apellidoPersona'].'</td><td width="190" align="center">'.$result1['nombre'].'</td><td width="50" align="center"><a href="#" onclick="eliminarHistCargoTD('.$idHistCargo.')">Eliminar</a></td></tr>';
		
		$result1 = mysql_fetch_assoc($result);
	}
	
	
	
	include "../db/cerrar_conexion.php";
?>