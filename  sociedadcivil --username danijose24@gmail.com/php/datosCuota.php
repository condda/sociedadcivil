<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$cedulaPersona = $_REQUEST['phpCedulaPersona'];
	$tipoCuota = $_REQUEST['phpTipoCuota'];
	$result = mysql_query("select * FROM  persona where cedulaPersona = '$cedulaPersona'");
	$result1 = mysql_fetch_assoc($result);
	
	$nombrePersona = $result1['nombrePersona'];
	$apellidoPersona = $result1['apellidoPersona'];

	$result = mysql_query ("select * from cuota where tipoCuota = '$tipoCuota'");
	
	echo '<strong>Nombre: </strong>'.$nombrePersona.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<strong>Apellido: </strong>'.$apellidoPersona.'<br>';
	echo 'Mes a cancelar <select name="MesCuota" id="MesCuota" onchange="montoMesCuota()">';
	echo '<option value="0">Seleccione</option>';
	while ($result1 = mysql_fetch_assoc($result)){
		 echo '<option value="'.$result1['idCuota'].'">'.$result1['mesCuota'].'</option>';
		
		
	}
	echo '</select>';
	echo '<input type="hidden" name="cedulaPOculto" id="cedulaPOculto" value="'.$cedulaPersona.'"/><input type="hidden" name="tipoCuota" id="tipoCuota" value="'.$tipoCuota.'"/>';
	echo '<div id="mensajeVal"></id>';
	
	include "../db/cerrar_conexion.php";
?>
	