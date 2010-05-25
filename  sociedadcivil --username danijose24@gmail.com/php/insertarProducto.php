<?

include "../db/conexion.php";

$rifCi =  $_POST['phpProducto'];
$i = 1;

while ($i<=$rifCi){

echo '<BR><table width="232" border="0">
    <tr>
      <td>Nombre</td>
      <td><input type="text" name="nombre'.$i.'" id="nombre'.$i.'"/></td>
    </tr>
    <tr>
      <td>Descripcion</td>
      <td><input type="text" name="descripcion'.$i.'" id="descripcion'.$i.'" /></td>
    </tr>
    <tr>
      <td width="72">Precio</td>
      <td width="144"><input type="text" name="precio'.$i.'" id="precio'.$i.'" /></td>
    </tr>
     </table>';
	 $i = $i+1;
}




?>