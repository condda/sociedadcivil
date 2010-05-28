<?

include "../db/conexion.php";
$placa = $_POST['phpPlaca'];


if ($placa){
	 
	 $result = mysql_query("select * from vehiculo where placaVehiculo = '$placa'");
	 
	
	 
		$result1 = mysql_fetch_assoc($result);
		if ($result1['idVehiculo']){
			echo "El vehiculo ya se encuentra en nuestra base de datos";
			echo '<input type="hidden" name="flagPlaca" id="flagPlaca" value= "1" />';
			
		}
		else{
			echo "El vehiculo puede ser registrado";
			echo '<input type="hidden" name="flagPlaca" id="flagPlaca" value= "0" />';
			
		}
	

  }
 

?>
