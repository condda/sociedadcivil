<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$idCuota = $_REQUEST['phpIdCuota'];
	$tipoCuota = $_REQUEST['phpTipoCuota'];
	$cedulaPersona = $_REQUEST['phpCedulaPersona'];
	
	$nombrePersona = $result1['nombrePersona'];
	$apellidoPersona = $result1['apellidoPersona'];

	$result = mysql_query ("select * from cuota where idCuota = '$idCuota'");
	$result1 = mysql_fetch_assoc($result);

	
	if ($result1['numeroMesCuota']<10)
 	$fechaC = "2010-0".$result1['numeroMesCuota']."-01";
	else
	$fechaC = $ano."-".$result1['numeroMesCuota']."-01";
	
	
	$numDias = floor((strtotime($date1) - strtotime($fechaC))/86400);
	echo 'Monto a cancelar <input type="text" name="montoPago" id="montoPago" value="'.$result1['montoCuota'].'" disabled/><br>';
	
	 if (($numDias > 20) && ($numDias <= 30)){
		
		$result2 = mysql_query("select * from norma where montoNorma != '0'");
		$result3 = mysql_fetch_assoc($result2);
		
		echo "<strong>Adicionalmente tiene un recargo de ".$result3['montoNorma']." BsF.".'</strong><br>';
	}
	else if ($numDias >30){
		
		$result2 = mysql_query("select * from norma where montoNorma != '0'");
		$result3 = mysql_fetch_assoc($result2);
		$result3 = mysql_fetch_assoc($result2);
		echo "<strong>Adicionalmente tiene un recargo de ".$result3['montoNorma']." BsF.".'</strong><br>';
	}
	
	
	if (!$result3['idNorma'])
	$idNorma = 0;
	else
	$idNorma = $result3['idNorma'];
	
	echo '<input type="hidden" name="cedulaPOculto" id="cedulaPOculto" value="'.$cedulaPersona.'"/><input type="hidden" name="idCuota" id="idCuota" value="'.$idCuota.'"/><input type="hidden" name="idNorma1" id="idNorma1" value="'.$idNorma.'"/><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="Finalizar" align="middle" onclick="insertarCuota()" />';
	
	include "../db/cerrar_conexion.php";
?>
	