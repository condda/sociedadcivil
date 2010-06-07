<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$cedulaPersona = $_REQUEST['phpCedulaPersona'];
	$montoPago = $_REQUEST['phpMontoPago'];
	
	/*
	1) verificar si tiene un retraso:
		 si tiene el retraso hay que crearle en cuota_socio o cuota_avance el idRecargo ya sea de 5 bs o 20 bs
		 si no tiene retraso se queda null
	2) creamos Cuota y cuota_socio
		si tiene retraso hay que crear una sancion con el id de cuota y tambien una multa con esta sancion, la norma a aplicar es la 10.
		(revisar si es totalmente necesario el id de norma)
	3) por ultimo crear el ingreso
	*/
	
	include "../db/cerrar_conexion.php";
?>
	