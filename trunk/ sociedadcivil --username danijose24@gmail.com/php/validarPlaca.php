<?

include "../db/conexion.php";
$placa = $_POST['phpPlaca'];
$tipo = $_POST['phpTipo'];
$cedulaPersona = $_POST['phpCedulaPersona'];

if ($placa){
	 
	 
	 $result = mysql_query("select * from vehiculo where placaVehiculo = '$placa'");
	 
	
	 
		$result1 = mysql_fetch_assoc($result);
		if ($tipo != 2){
			if ($result1['idVehiculo']){
							
				echo "El vehiculo ya se encuentra en nuestra base de datos";
				echo '<input type="hidden" name="flagPlaca" id="flagPlaca" value= "1" />';
				
			}
			else{
				echo "El vehiculo puede ser registrado";
				echo '<input type="hidden" name="flagPlaca" id="flagPlaca" value= "0" />';
			}
				
			
		}
		else
		{
			if ($result1['idVehiculo']){
				
				$result = mysql_query("select va.idVehiculo from vehiculo v,vehiculo_avance va where v.placaVehiculo = '$placa' AND v.idVehiculo = va.idVehiculo AND  va.cedulaPersona = '$cedulaPersona'");

				if ($result1 = mysql_fetch_assoc($result)){
					echo "El vehiculo ya esta asignado al avance";
					echo '<input type="hidden" name="flagPlaca" id="flagPlaca" value= "1 />';
					
				}
				else{
					echo "El vehiculo puede ser asociado al Avance";
					echo '<input type="hidden" name="flagPlaca" id="flagPlaca" value= "0" />';
				}
				
			}
			else{
				
				echo "El vehiculo no se encuentra en nuestra base de datos";
				echo '<input type="hidden" name="flagPlaca" id="flagPlaca" value= "1" />';
				
				
			}
			
		}
	

  }
 

?>
