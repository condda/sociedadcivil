<?

include "../db/conexion.php";





$result = mysql_query ("select * from proveedor",$conexion);
$result1 = mysql_fetch_assoc($result);

echo '<select name="selectProveedor"  onchange="actualizarProveedor(1)" id="selectProveedor"">
      <option value="0" selected="selected">Seleccione</option>';
	  while ($result1 = mysql_fetch_assoc($result)){
		  
		echo '<option value="'.$result1['idProveedor'].'">'.$result1['nombreProveedor'].'</option>';
	  }
	
	
	
?>