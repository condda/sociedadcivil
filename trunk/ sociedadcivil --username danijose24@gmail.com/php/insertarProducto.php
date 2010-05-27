<?

include "../db/conexion.php";

$rifCi =  $_POST['phpProducto'];
$i = 1;

while ($i<=$rifCi){

echo '<BR><h1>Producto '.$i.'</h1>
	<BR> <table width="300" border="0">
    <tr>
      <td>Codigo</td>
      <td><input name="codigoProducto'.$i.'" type="text" id="codigoProducto'.$i.'" onchange="ValidarCodigoProducto('.$i.')" /></td>
	 
    </tr>
	
    <tr>
      <td>Nombre</td>
      <td><input name="nombreProducto'.$i.'" type="text" id="nombreProducto'.$i.'" maxlength="18"/></td>
    </tr>
    <tr>
      <td>Descripcion</td>
      <td><input name="descripcionProducto'.$i.'" type="text" id="descripcionProducto'.$i.'" maxlength="30"/></td>
    </tr>
    <tr>
      <td>Precio</td>
      <td><input name="precioProducto'.$i.'" type="text" id="precioProducto'.$i.'" maxlength="9"/></td>
    </tr>
    <tr>
      <td width="72">Cantidad</td>
      <td width="144"><input name="cantidadProducto'.$i.'" type="text" id="cantidadProducto'.$i.'" maxlength="9"/></td>
    </tr>
	  </table><p style="color:#6F0">--------------------------------------------------------</p>';
	 
	 $i = $i+1;
}

echo '<div id="mensajeProducto"><input type="hidden" name="flagProducto" id="flagProducto" value="0" /></div>';


?>