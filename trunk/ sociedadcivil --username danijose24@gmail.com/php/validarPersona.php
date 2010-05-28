<?

include "../db/conexion.php";
$cedulaPersona = $_POST['phpCedulaPersona'];
$cedulaBeneficiario = $_POST['phpCedulaBeneficiario'];
$tipo = $_POST['phpTipo'];

 
  if (($cedulaPersona)&&(!$cedulaBeneficiario)){
	 
	 if ($tipo == 1){ //socio
		 $result = mysql_query("select * from socio where cedulaPersona = '$cedulaPersona'");
		 
	 }
	 if ($tipo == 2){ // avance
	 	 $result = mysql_query("select * from avance where cedulaPersona = '$cedulaPersona'");
	 }
	
		$result1 = mysql_fetch_assoc($result);
		if ($result1['cedulaPersona']){
			
			
			if ($tipo == 1)
			echo "La persona ya se encuentra registrada en nuestra base de datos como Socio";
			
			if ($tipo == 2)
			echo "La persona ya se encuentra registrada en nuestra base de datos como Avance";
			
			
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
  
  if (($cedulaPersona) && ($cedulaBeneficiario) && ($tipo == 3)){
	   
		 $result = mysql_query("select * from socio_beneficiario where cedulaBeneficiario = '$cedulaBeneficiario' AND cedulaPersona = '$cedulaPersona'");
	 	 $result1 = mysql_fetch_assoc($result);
			if ($result1){
				
				
				echo "El beneficiario ya esta asociado con el socio";
				echo '<input name="flagBeneficiario" type="hidden" id="flagBeneficiario" value="1">';
			}
			
			else{
				 $result = mysql_query("select * from beneficiario where cedulaBeneficiario = '$cedulaBeneficiario'");
				 if ($result1 = mysql_fetch_assoc($result)){
					 echo '<tr>
   					<td width="146" class="ppppp">Nombre</td>
    				<td width="172"><input name="nombre" type="text" id="nombre" maxlength="15" value="'.$result1['nombreBeneficiario'].'" readonly></td>
    				
    			 	 <td class="ppppp">Apellido</td>
     				 <td><input name="apellido" type="text" id="apellido" maxlength="15" value="'.$result1['nombreBeneficiario'].'" readonly></td>
  					</tr>';
					 
				 }
				 else{
					 
					 echo '<td width="146" class="ppppp">Nombre</td>
    				<td width="172"><input name="nombre" type="text" id="nombre" maxlength="15"></td>
    				</tr>
    				<tr>
    			 	 <td class="ppppp">Apellido</td>
     				 <td><input name="apellido" type="text" id="apellido" maxlength="15"></td>
  					</tr>';
				 }
				 
			}
			
  }
	
?>
