<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$tipoCuota = $_REQUEST['phpTipoCuota'];
	$idCuota = $_REQUEST['phpIdCuota'];
	if (!$idCuota){
		$result = mysql_query ("select * from cuota where tipoCuota = '$tipoCuota'");
		echo '<select name="listaCuota" id="listaCuota" onchange="consultaCuota()">';
		echo '<option value="0" selected="selected">Seleccione</option>';
		while ($result1 = mysql_fetch_assoc($result)){
		echo '<option value="'.$result1['idCuota'].'">'.$result1['mesCuota'].'</option>';

		}
	}
	else{
		$result = mysql_query ("select * from cuota where idCuota = '$idCuota'");
		$result1 = mysql_fetch_assoc($result);
		echo '<td width="200" align="center">Mes</td><td width="200" align="center">Monto</td><br>';
		echo '<td width="200" align="center">'.$result1['mesCuota'].'</td><td width="200" align="center">'.$result1['montoCuota'].' Bs.</td><td width="200" align="center"><a href="#" onclick="modificarCuota('.$result1['idCuota'].')">Modificar</a></td>';
		
	}
	include "../db/cerrar_conexion.php";
?>
