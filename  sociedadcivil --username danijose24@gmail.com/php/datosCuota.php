<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$cedulaPersona = $_REQUEST['phpCedulaPersona'];
	
	$result = mysql_query("select * FROM  persona where cedulaPersona = '$cedulaPersona'");
	$result1 = mysql_fetch_assoc($result);
	
	$nombrePersona = $result1['nombrePersona'];
	$apellidoPersona = $result1['apellidoPersona'];
	echo '<strong>Nombre: </strong>'.$nombrePersona.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<strong>Apellido: </strong>'.$apellidoPersona.'<br>';
	echo 'Monto a cancelar <input type="text" name="montoPago" id="montoPago" onchange="colocarBoton()" /><input type="hidden" name="cedulaPOculto" id="cedulaPOculto" value="'.$cedulaPersona.'"/>';
	echo '<div id="mensajeVal"></id>';
	
	include "../db/cerrar_conexion.php";
?>
	