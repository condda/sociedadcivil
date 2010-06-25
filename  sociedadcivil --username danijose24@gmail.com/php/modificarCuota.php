<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	
	$idCuota = $_REQUEST['phpIdCuota'];
	$flag = $_REQUEST['phpFlag'];
	$montoCuota = $_REQUEST['phpMontoCuota'];
	
	if (!$flag){
		$result = mysql_query ("select * from cuota where idCuota = '$idCuota'");
		$result1 = mysql_fetch_assoc($result);
		echo '<td width="200" align="center">Mes</td><td width="200" align="center">Monto</td><br>';
		echo '<td width="200" align="center">'.$result1['mesCuota'].'</td>';
		echo '<td width="300" align="center"><input name="montoCuota" type="text" id="montoCuota" value="'.$result1['montoCuota'].'"/></td>';
		echo '<td align="left"><input type="button" value="Modificar" onclick="actualizarMonto('.$idCuota.')"/></td>';
	}
	
	else{
		
		mysql_query ("update cuota set montoCuota = '$montoCuota' where idCuota = '$idCuota'");
		
		$result = mysql_query ("select * from cuota where idCuota = '$idCuota'");
		$result1 = mysql_fetch_assoc($result);
		echo '<td width="200" align="center">Mes</td><td width="200" align="center">Monto</td><br>';
		echo '<td width="200" align="center">'.$result1['mesCuota'].'</td><td width="200" align="center">'.$result1['montoCuota'].' Bs.</td><td width="200" align="center"><a href="#" onclick="modificarCuota('.$result1['idCuota'].')">Modificar</a></td>';
		
		
	}
	
	include "../db/cerrar_conexion.php";
?>
