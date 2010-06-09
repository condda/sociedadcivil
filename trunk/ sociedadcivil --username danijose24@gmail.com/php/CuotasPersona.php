<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$cedulaPersona = $_REQUEST['phpCedulaPersona'];
	$tipoPersona = $_REQUEST['phpTipoPersona'];
	$montoMulta = 0;
	$tipoCuota = $_REQUEST['phpTipoCuota'];
	
	
	echo '<input type="hidden" name="tipoPer" id="tipoPer" value="'.$tipoPersona.'"/>';
	if (($tipoPersona == 1) && ($tipoCuota == 1)){
		$result = mysql_query("select P.nombrePersona, P.apellidoPersona FROM  persona P, socio S where S.cedulaPersona = '$cedulaPersona' AND S.cedulaPersona = P.cedulaPersona");
		
		
		if ($result1 = mysql_fetch_assoc($result)){
			$nombrePersona = $result1['nombrePersona'];
			$apellidoPersona = $result1['apellidoPersona'];
			
			echo '<strong>Nombre: </strong>'.$nombrePersona.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<strong>Apellido: </strong>'.$apellidoPersona.'<br>';
		
			$result = mysql_query("select CS.fechaCuota as fechaCuotaS, CS.montoCuotaSocio, CS.idCuota  FROM  persona P,socio S, cuota C, cuota_socio CS where P.cedulaPersona = '$cedulaPersona' AND P.cedulaPersona = S.cedulaPersona AND S.cedulaPersona = CS.cedulaPersona AND CS.idCuota = C.idCuota order by CS.fechaCuota desc limit 1");
			if ($result1 = mysql_fetch_assoc($result)){
				$fechaCuota = $result1['fechaCuotaS'];
				$montoCuota = $result1['montoCuotaSocio'];
				$idNorma = $result1['idNorma'];
				$idCuota = $result1['idCuota'];
				
				echo '<strong>Fecha del ultimo pago ordinario: </strong>'.$fechaCuota.'<br>
	<strong>Dias transcurridos: </strong>'.floor(abs(strtotime($date1) - strtotime($fechaCuota))/86400).'<br>
	<strong>Monto: </strong>'.$montoCuota.'<br>';

				if ($idNorma){
		
					$result2 = mysql_query("SELECT * FROM cuota C, norma N, multa M WHERE C.idCuota ='$idCuota' AND N.idNorma = '$idNorma' AND N.idNorma = M.idNorma order BY M.idMulta desc limit 1");
					$result3 = mysql_fetch_assoc($result2);
					$montoMulta = $result3['montoMulta'];
					echo '<strong>Recargo: </strong>'.$result3['montoMulta'].'<br>';
					echo '<strong>Motivo: </strong>'.$result3['descripcionNorma'].'<br>';
					
					
					$total = $montoMulta+$result3['montoCuota'];
					echo '<strong>Total: </strong>'.$total.'<br>';
				}
	
			
			}
			else
				echo "No se encuentra registrada ninguna cuota".'<BR>';
				
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="Continuar" align="middle" onclick="datosCuota()"  />';
		
		}
		else
			echo "No se encuentra la persona en nuestra base de datos";
		
		
		
		
	
	}
	
		
	
	if (($tipoPersona == 2) && ($tipoCuota == 1) ){
		
		$result = mysql_query("select P.nombrePersona, P.apellidoPersona FROM  persona P, avance A where A.cedulaPersona = '$cedulaPersona' AND A.cedulaPersona = P.cedulaPersona");
		
		
		if ($result1 = mysql_fetch_assoc($result)){
			$nombrePersona = $result1['nombrePersona'];
			$apellidoPersona = $result1['apellidoPersona'];
			
			echo '<strong>Nombre: </strong>'.$nombrePersona.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<strong>Apellido: </strong>'.$apellidoPersona.'<br>';
			
			$result = mysql_query("select CA.fechaCuota, C.montoCuota, C.idRecargo, CA.idCuota  FROM  persona P,avance A, cuota C, cuota_avance CA where P.cedulaPersona = '$cedulaPersona' AND P.cedulaPersona = A.cedulaPersona AND A.cedulaPersona = CA.cedulaPersona AND CA.idCuota = C.idCuota AND C.tipoCuota = '1' ORDER BY CA.idCuota DESC LIMIT 1");
			if ($result1 = mysql_fetch_assoc($result)){
				$fechaCuota = $result1['fechaCuota'];
				$montoCuota = $result1['montoCuota'];
				$idRecargo = $result1['idRecargo'];
				$idCuota = $result1['idCuota'];
				
				echo '<strong>Fecha del ultimo pago ordinario: </strong>'.$fechaCuota.'<br>
	<strong>Dias transcurridos: </strong>'.floor(abs(strtotime($date1) - strtotime($fechaCuota))/86400).'<br>
	<strong>Monto: </strong>'.$montoCuota.'<br>';

				if ($idRecargo){
		
					$result2 = mysql_query("SELECT * FROM cuota C, recargo R, sancion S, multa M WHERE C.idCuota ='$idCuota' AND C.idRecargo = R.idRecargo AND C.idCuota = S.idCuota AND S.idSancion = M.idSancion order BY M.idMulta desc limit 1");
					$result3 = mysql_fetch_assoc($result2);
					$montoMulta = $result3['montoMulta'];
					echo '<strong>Recargo: </strong>'.$result3['montoMulta'].'<br>';
					echo '<strong>Motivo: </strong>'.$result3['descripcionRecargo'].'<br>';
					
					
					$total = $montoMulta+$result3['montoCuota'];
					echo '<strong>Total: </strong>'.$total.'<br>';
				}
	
			
			}
			else
				echo "No se encuentra registrada ninguna cuota".'<br>';
				
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="Continuar" align="middle" onclick="datosCuota()" />';
		
		}
		else
			echo "No se encuentra la persona en nuestra base de datos";
		
		
	
	
	}
	
		

		
		
	
	
		
		
	
		
	include "../db/cerrar_conexion.php";
?>
	