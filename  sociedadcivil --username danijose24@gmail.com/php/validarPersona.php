<?

include "../db/conexion.php";
$cedulaPersona = $_POST['phpCedulaPersona'];
$cedulaBeneficiario = $_POST['phpCedulaBeneficiario'];
$tipo = $_POST['phpTipo'];

 
  if ($cedulaPersona){
	 
	 if ($tipo == 1){ //socio
		 $result = mysql_query("select * from socio where cedulaPersona = '$cedulaPersona'");
		 
	 }
	 if ($tipo == 2){ // avance
	 	 $result = mysql_query("select * from avance where cedulaPersona = '$cedulaPersona'");
	 }
	 if ($tipo == 3){
		 $result = mysql_query("select * from socio_beneficiario where cedulaBeneficiario = '$cedulaBeneficiario' AND cedulaPersona = '$cedulaPersona'");
	 }
		$result1 = mysql_fetch_assoc($result);
		if ($result1['cedulaPersona']){
			
			
			if ($tipo == 1)
			echo "La persona ya se encuentra registrada en nuestra base de datos como Socio";
			
			if ($tipo == 2)
			echo "La persona ya se encuentra registrada en nuestra base de datos como Avance";
			
			if ($tipo == 3){
				
				
				echo "El beneficiario ya esta asociado con el socio";
				echo '<input name="flagBeneficiario" type="hidden" id="flagBeneficiario" value="1">';
			}
			
			
		}
		else{
		if ($tipo != 3){
		echo "La persona puede ser registrada";
		echo '<BR><input name="enviar" type="submit" id="enviar" value="Continuar Inscripcion">';
		}
		else{
			echo "El beneficiario puede ser registrado";
			echo '<input name="flagBeneficiario" type="hidden" id="flagBeneficiario" value="0">';
			
		}
		
		

		}
  }
	
?>
