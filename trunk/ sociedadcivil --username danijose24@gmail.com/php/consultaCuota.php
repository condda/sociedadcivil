<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$tipoCuota = $_REQUEST['phpTipoCuota'];
	$cedulaPersona = $_REQUEST['phpCedulaPersona'];

	
	if (!cedulaPersona){
	$result = mysql_query ("select * from cuota where tipoCuota = '$tipoCuota'");
	echo '<select name="listaCuota" id="listaCuota" onchange="consultaCuota()">';
	echo '<option value="0" selected="selected">Seleccione</option>';
	while ($result1 = mysql_fetch_assoc($result)){
	echo '<option value="'.$result1['idCuota'].'">'.$result1['mesCuota'].'</option>';
//	echo '<td>'.$result1['mesCuota'].'</td><td>'.$result1['montoCuota'].'</td><a href="#" onclick="modificarCuota('.$result1['idCuota'].')">Modificar</a>';
	
		
	}
	
	
	}
	else{
		$tipoPersona = 0;
		$result = mysql_query ("Select * from cuota_socio where cedulaPersona = '$cedulaPersona'");
		if (!$result1 = mysql_fetch_assoc($result)){
			$result = mysql_query ("Select * from cuota_avance where cedulaPersona = '$cedulaPersona'");
			if ($result1 = mysql_fetch_assoc($result)){
				$tipoPersona = 2;
				
				
			}
			else{
				
					echo "No se encuentra la persona en nuestra base de datos";
				
			}
		}
		else
			$tipoPersona = 1;	
			
			
			
			
		if ($tipoPersona == 1){
			$result = mysql_query ("select nombrePersona, apellidoPersona from Persona where cedulaPersona = '$cedulaPersona'");
			$result1 = mysql_fetch_assoc($result);
			$nombrePersona = $result1['nombrePersona'];
			$apellidoPersona = $result1['apellidoPersona'];
		

			echo '<strong>Nombre: </strong>'.$nombrePersona.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<strong>Apellido: </strong>'.$apellidoPersona.'<br><br>';
			$result = mysql_query ("select CS.idCuotaSocio, CS.fechaCuota, CS.montoCuotaSocio, C.mesCuota from cuota_socio CS, cuota C where CS.cedulaPersona = 							'$cedulaPersona' AND CS.idCuota = C.idCuota AND C.tipoCuota = '$tipoCuota' order by CS.fechaCuota");
			
			if ($result1 = mysql_fetch_assoc($result)){
				echo '<tr><td width="200" align="center"><strong>Fecha</strong></td><td width="200" align="center"><strong>Mes Correspondiente</strong></td><td width="200" align="center"><strong>Monto</strong></td><td width="200" align="center"><strong> Multa</strong></td><td width="200" align="center"><strong>Motivo Multa</strong></td></tr>';
				
			}
			else
			echo "No se encuentran cuotas registradas";
			
			while ($result1){	
			
				$idCuotaSocio = $result1['idCuotaSocio'];
			
			
				$result2 = mysql_query("select M.montoMulta, N.descripcionNorma from multa M, norma N where M.idCuotaSocio = '$idCuotaSocio' AND M.idNorma = N.idNorma");	
				$result3 = mysql_fetch_assoc($result2);
				
				
				echo '<tr><td align="center">'.$result1['fechaCuota'].'</td><td align="center">'.$result1['mesCuota'].'</td><td align="center">'.$result1['montoCuotaSocio'].'</td><td align="center">'.$result3['montoMulta'].'</td><td align="center">'.$result3['descripcionNorma'].'</td></tr>';
				
				
				$result1 = mysql_fetch_assoc($result);
				
			}
			
		}
		
		
		if ($tipopersona == 2){
			
			
			
		}
			
		
		
		
		
		
	}
	include "../db/cerrar_conexion.php";
?>
