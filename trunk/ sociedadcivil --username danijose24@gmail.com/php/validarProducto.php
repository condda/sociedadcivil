<?

include "../db/conexion.php";
$productoCodigo = $_POST['phpproductoCodigo'];
$referencia = $_POST['phpref'];

  
  if ($productoCodigo){
	 
	 $result = mysql_query("select * from Producto where idProducto = '$productoCodigo'");
		$result1 = mysql_fetch_assoc($result);
		if ($result1['idProducto']){
			echo "El codigo de producto ya se encuentra en nuestra base de datos";
			echo '<input type="hidden" name="flagProducto" id="flagProducto" value= "1" />';
			
		}
		else{
			echo '<input type="hidden" name="flagProducto" id="flagProducto" value= "0" />';
			
			if($referencia == 'producto'){
				
			echo '<input type="submit" name="button" id="button" value="Crear" />';	
			}
		}
	

  }
 

?>
