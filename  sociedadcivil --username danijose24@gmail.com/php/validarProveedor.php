<?

include "../db/conexion.php";
$ciRifProveedor = $_POST['phpRifCiProveedor'];
$rifCi =  $_POST['RifCiProveedor'];
  
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
			echo "El proveedor ya se encuentra en nuestra base de datos"
		}

  }
  if ($_POST['phpProveedor'] == 0){
  echo "es seleccione	 ".$_POST['phpProveedor'];
  }
  else{
	  
	  echo '<table width="200" border="1">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>'.$_POST['phpProveedor'];
  
  }
  
?>
