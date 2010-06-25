<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$cedulaPersona = $_REQUEST['phpcedulaPersona'];
	$linkSoAv = $_REQUEST['phplinkSoAv'];
	$consultarCodigo = $_REQUEST['phpconsultarCodigo'];
	$consultarCodigo2 = $_REQUEST['phpconsultarCodigo2'];
	$cedulaRetiro = $_REQUEST['phpcedulaRetiro'];
	$tipo = $_REQUEST['phptipo'];	
	$activar = $_REQUEST['phpactivar'];	
	$flag = $_REQUEST['phpflag'];	
	$montoTotal = $_REQUEST['phpmontoTotal'];	
	$razon = $_REQUEST['phprazon'];	
	$activarCrear = $_REQUEST['phpactivarCrear'];	
	$continuar = $_REQUEST['phpcontinuar'];	
	$cedulaB = $_REQUEST['phpcedulaB'];
	$listaSoAv1 = $_REQUEST['phplistaSoAv1'];
	$i=0;
	if (($cedulaPersona) && ($tipo)){
		if ($tipo==1){
			$i=0;
			$result = mysql_query("select b.* from socio_beneficiario sb,beneficiario b where sb.cedulaPersona='$cedulaPersona' and
								  sb.cedulaBeneficiario=b.cedulaBeneficiario");
	 		while ($result1 = mysql_fetch_assoc($result)){
				$i=$i+1;
				echo '<input type=checkbox name="b'.$i.'" id="b'.$i.'" 
				value="'.$result1['cedulaBeneficiario'].'"/>   
				'.$result1['apellidoBeneficiario'].', '.$result1['nombreBeneficiario'].'<br>';
			}
			echo '<input name="cont" type="hidden" id="cont" value="'.$i.'" />';
		}
		else
		{
			$i=0;
			$result = mysql_query("select b.* from avance_beneficiario ab,beneficiario b where ab.cedulaPersona='$cedulaPersona' and
								  ab.cedulaBeneficiario=b.cedulaBeneficiario");
	 		while ($result1 = mysql_fetch_assoc($result)){
				$i=$i+1;
				echo '<input type=checkbox name="b'.$i.'" id="b'.$i.'"
				value="'.$result1['cedulaBeneficiario'].'"/>   
				'.$result1['apellidoBeneficiario'].', '.$result1['nombreBeneficiario'].'<br>';
			}
			echo '<input name="cont" type="hidden" id="cont" value="'.$i.'" />';
		}
	}
	
	if($flag==11){
		echo '<input name="flagInsertar" type="hidden" id="flagInsertar" value="11" />';
		echo '<input name="flagMonto" type="hidden" id="flagMonto" value="'.$montoTotal.'" />';
	}
	else if($flag==10){
		echo '<input name="flagInsertar" type="hidden" id="flagInsertar" value="10" />';
		echo '<input name="flagMonto" type="hidden" id="flagMonto" value="'.$montoTotal.'" />';
	}
	if (($activar) && ($razon))
		if($razon==1)
			echo'<a href="../php/crearRetiro.php?listaSoAv1='.$listaSoAv1.'">Crear</a>';
		else
		 	echo'<a href="../php/crearRetiro2.php?listaSoAv1='.$listaSoAv1.'">Crear</a>';
	
	if($linkSoAv==1)
		echo'<a href="../php/consultarRetiro.php">Consultar</a>';
	else if($linkSoAv==2)
		echo'<a href="../php/consultarRetiro2.php">Consultar</a>';

	if ($activarCrear)
		echo '<input type="submit" name="button" id="button" value="Crear"/>';	

	if ($continuar)
		echo '<input type="button" name="button" onclick="validarCheckbox()" id="button" value="Verificar" />';
		
	if($cedulaB){
		$result = mysql_query("select * from Beneficiario where cedulaBeneficiario = '$cedulaB'");
		$result1 = mysql_fetch_assoc($result);
		if ($result1['cedulaBeneficiario'])
			echo "Este Beneficiario ya existe dentro de la Sociedad!";
		else
			echo '<input type="submit" name="button" id="button" value="Crear" />';	
	}

	if(($cedulaRetiro)&&($tipo)){
		$mayor=0;
		$result = mysql_query("SELECT fechaAInscripcion FROM inscripcion WHERE cedulaPersona='$cedulaRetiro' and estatusInscripcion='1'");
		$result1 = mysql_fetch_assoc($result);
		$fecha = $result1['fechaAInscripcion']; 
		$diferencia = abs((strtotime($date1) - strtotime($fecha))/86400);  
		if($diferencia>=365){
			$mayor=1;
			$anios=floor($diferencia/365);
		}
		else
			$mayor=0;
		if($mayor){
			/*$result = mysql_query("SELECT p.costoPasaje FROM pasaje p WHERE p.idPasaje = (
									SELECT h1.idPasaje
									FROM hist_pasaje h1
									WHERE h1.fechaHistPasaje
									IN (SELECT MAX( h2.fechaHistPasaje ) 
									FROM hist_pasaje h2))");*/
			
			$result = mysql_query("select min(hp.costoHistPasaje) as costoPasaje from ruta r, pasaje p, hist_pasaje hp where
									r.idRuta=p.idRuta
									and
									p.idPasaje=hp.idPasaje
									and
									r.vigenteRuta='1'");
			$result1 = mysql_fetch_assoc($result);
			extract($result1);
			$montoTotal=$costoPasaje*10;
			
			if($tipo==1){
				$result = mysql_query("select count(p.cedulaPersona) as count from socio s, persona p where s.cedulaPersona=p.cedulaPersona and p.estatusPersona is NULL");
				$result1 = mysql_fetch_assoc($result);
				extract($result1);
			}
			else if($tipo==2){
				$result = mysql_query("select count(p.cedulaPersona) as count from avance a, persona p where a.cedulaPersona=p.cedulaPersona and p.estatusPersona is NULL");
				$result1 = mysql_fetch_assoc($result);
				extract($result1);
			}
			$montoTotal=$montoTotal*$count*$anios;

			
		  echo'<table width="370" border="0">
				<tr>
				  <td width="120">Monto Total</td>
				  <td width="250"><input name="monto" type="text" id="monto" value="'.$montoTotal.'" size="11" readonly="readonly" />Bsf.</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td><input type="submit" name="button" id="button" value="Crear"/></td>
				</tr>
			  </table>';
	  		echo '<input name="flagInsertar" type="hidden" id="flagInsertar" value="11" />';

			//echo '<p><input name="monto" type="text" id="monto" value="'.$montoTotal.'" size="11" readonly="readonly" />Bsf.</p>';
			//echo '<p><input type="submit" name="button" id="button" value="Crear"/></p>';	
		}
		else{
			echo "Debe tener mas de un a7o de servicio para poder retirarse de la sociedad...";
	  		echo '<input name="flagInsertar" type="hidden" id="flagInsertar" value="10" />';			
		}
	}
	
	if($consultarCodigo)
	{
		$result = mysql_query("select * from Fondo_Socio where idFondoSocio = '$consultarCodigo'");
		$result1 = mysql_fetch_assoc($result);
		if ($result1['idFondoSocio']){
			if($result1['idFondo']==3){
				$retiro='Retiro: Por fallecimiento';
				$cedP=$result1['cedulaPersona'];
				$result2 = mysql_query("select * from Persona where cedulaPersona = '$cedP'");
				$result3 = mysql_fetch_assoc($result2);
				$cedB=$result1['cedulaBeneficiario'];
				$result4 = mysql_query("select * from Beneficiario where cedulaBeneficiario = '$cedB'");
				$result5 = mysql_fetch_assoc($result4);
				echo'<table width="250" height="0" border="0" ><tr><td>Codigo: '.$result1['idFondoSocio'].'</td>
					<tr><td>'.$retiro.'</td></tr><tr><td>Monto:'.$result1['montoFondoSocio'].'Bsf.</td></tr><tr>
					<td>Fecha:'.$result1['fechaFondoSocio'].'</td></tr><tr><td>Socio:</td></tr><tr><td>Cedula: '.$result1['cedulaPersona'].'
					</td></tr><tr>
					<td>Nombre: '.$result3['nombrePersona'].'</td></tr><tr><td>Apellido: '.$result3['apellidoPersona'].'</td></tr><tr>
					<td>Beneficiario:</td></tr><tr><td>Cedula: '.$result1['cedulaBeneficiario'].'</td></tr><tr>
					<td>Nombre: '.$result5['nombreBeneficiario'].'</td></tr><tr><td>Apellido: '.$result5['apellidoBeneficiario'].'</td></tr>		</table>';
				}
			else{
				$retiro='Retiro: Voluntario';
	  			$cedP=$result1['cedulaPersona'];
				$result2 = mysql_query("select * from Persona where cedulaPersona = '$cedP'");
				$result3 = mysql_fetch_assoc($result2);
				echo'<table width="250" height="0" border="0" ><tr><td>Codigo: '.$result1['idFondoSocio'].'</td>
					<tr><td>'.$retiro.'</td></tr><tr><td>Monto:'.$result1['montoFondoSocio'].'Bsf.</td></tr><tr>
					<td>Fecha:'.$result1['fechaFondoSocio'].'</td></tr><tr><td>Socio:</td></tr><tr><td>Cedula: '.$result1['cedulaPersona'].'
					</td></tr><tr>
					<td>Nombre: '.$result3['nombrePersona'].'</td></tr><tr><td>Apellido: '.$result3['apellidoPersona'].'</td></tr></table>';
			}
		}
		else
			echo "Este codigo no existe dentro de la base de datos...";
	}
	
	if($consultarCodigo2)
	{
		$result = mysql_query("select * from Fondo_Avance where idFondoAvance = '$consultarCodigo2'");
		$result1 = mysql_fetch_assoc($result);
		if ($result1['idFondoAvance']){
			if($result1['idFondo']==3){
				$retiro='Retiro: Por fallecimiento';
				$cedP=$result1['cedulaPersona'];
				$result2 = mysql_query("select * from Persona where cedulaPersona = '$cedP'");
				$result3 = mysql_fetch_assoc($result2);
				$cedB=$result1['cedulaBeneficiario'];
				$result4 = mysql_query("select * from Beneficiario where cedulaBeneficiario = '$cedB'");
				$result5 = mysql_fetch_assoc($result4);
				echo'<table width="250" height="0" border="0" ><tr><td>Codigo: '.$result1['idFondoAvance'].'</td>
					<tr><td>'.$retiro.'</td></tr><tr><td>Monto:'.$result1['montoFondoAvance'].'Bsf.</td></tr><tr>
					<td>Fecha:'.$result1['fechaFondoAvance'].'</td></tr><tr><td>Socio:</td></tr><tr><td>Cedula: '.$result1['cedulaPersona'].'
					</td></tr><tr>
					<td>Nombre: '.$result3['nombrePersona'].'</td></tr><tr><td>Apellido: '.$result3['apellidoPersona'].'</td></tr><tr>
					<td>Beneficiario:</td></tr><tr><td>Cedula: '.$result1['cedulaBeneficiario'].'</td></tr><tr>
					<td>Nombre: '.$result5['nombreBeneficiario'].'</td></tr><tr><td>Apellido: '.$result5['apellidoBeneficiario'].'</td></tr>		</table>';
				}
			else{
				$retiro='Retiro: Voluntario';
	  			$cedP=$result1['cedulaPersona'];
				$result2 = mysql_query("select * from Persona where cedulaPersona = '$cedP'");
				$result3 = mysql_fetch_assoc($result2);
				echo'<table width="250" height="0" border="0" ><tr><td>Codigo: '.$result1['idFondoAvance'].'</td>
					<tr><td>'.$retiro.'</td></tr><tr><td>Monto:'.$result1['montoFondoAvance'].'Bsf.</td></tr><tr>
					<td>Fecha:'.$result1['fechaFondoAvance'].'</td></tr><tr><td>Socio:</td></tr><tr><td>Cedula: '.$result1['cedulaPersona'].'
					</td></tr><tr>
					<td>Nombre: '.$result3['nombrePersona'].'</td></tr><tr><td>Apellido: '.$result3['apellidoPersona'].'</td></tr></table>';
			}
		}
		else
			echo "Este codigo no existe dentro de la base de datos...";
	}
	
	include "../db/cerrar_conexion.php";
?>