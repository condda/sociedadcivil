<?

include "../db/conexion.php";
$ciRifProveedor = $_POST['phpRifCiProveedor'];
$rifCi =  $_POST['phpRifCi'];
  
  if (($ciRifProveedor) && ($rifCi != 0)){
	  if ($rifCi==1)
		{
			$result = mysql_query("select idProveedor from Proveedor where cedulaProveedor = '$ciRifProveedor'");
			
		}
		else if ($rifCi==2)
		{
			$result = mysql_query("select idProveedor from Proveedor where rifProveedor = '$ciRifProveedor'");
			
		}
		
		$result1 = mysql_fetch_assoc($result);
		if ($result1['idProveedor']){
			echo "El proveedor ya se encuentra en nuestra base de datos";
			
		}
		else{
			echo "El proveedor puede ser registrado<BR>";
			echo '<input type="submit" name="button" id="button" value="Crear" />';
		}

  }
 

?>
