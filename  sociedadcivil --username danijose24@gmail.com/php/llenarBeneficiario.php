<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$cedulaPersona = $_REQUEST['phpcedulaPersona'];
	$tipo = $_REQUEST['phptipo'];	
	$activar = $_REQUEST['phpactivar'];	
	$cedulaB = $_REQUEST['phpcedulaB'];

	if (($cedulaPersona) && ($tipo)){
		if ($tipo==1){
			$result = mysql_query("select b.* from socio_beneficiario sb,beneficiario b where sb.cedulaPersona='$cedulaPersona' and
								  sb.cedulaBeneficiario=b.cedulaBeneficiario");
	 		while ($result1 = mysql_fetch_assoc($result))
				echo '<input type=checkbox name="beneficiario" id="'.$result1['cedulaBeneficiario'].'" 
				value="'.$result1['cedulaBeneficiario'].'">   
				'.$result1['apellidoBeneficiario'].', '.$result1['nombreBeneficiario'].'<br>';
		}
		else
		{
			$result = mysql_query("select b.* from avance_beneficiario ab,beneficiario b where ab.cedulaPersona='$cedulaPersona' and
								  ab.cedulaBeneficiario=b.cedulaBeneficiario");
	 		while ($result1 = mysql_fetch_assoc($result))
				echo '<input type=checkbox name="beneficiario" id="'.$result1['cedulaBeneficiario'].'"
				value="'.$result1['cedulaBeneficiario'].'">   
				'.$result1['apellidoBeneficiario'].', '.$result1['nombreBeneficiario'].'<br>';
		}
	}
	
	if ($activar)
		echo '<input type="submit" name="button" id="button" value="Crear" />';	
		
	if($cedulaB){
		$result = mysql_query("select * from Beneficiario where cedulaBeneficiario = '$cedulaB'");
		$result1 = mysql_fetch_assoc($result);
		if ($result1['cedulaBeneficiario'])
			echo "Este Beneficiario ya existe dentro de la Sociedad!";
		else
			echo '<input type="submit" name="button" id="button" value="Crear" />';	
	}

	include "../db/cerrar_conexion.php";
?>