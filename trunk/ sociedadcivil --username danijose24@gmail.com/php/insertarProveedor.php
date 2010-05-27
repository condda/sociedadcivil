<?

include "../db/conexion.php";







echo '<table width="293" border="0">
		<tr>
      <td width="99"><select name="ciRif" id="ciRif" onchange="cedulaRifProveedor()">
        <option value="0">Seleccione</option>
        <option value="1">Cedula</option>
        <option value="2">Rif</option>
      </select></td>
      <td width="28"><div id="rif"></div>
      </td>
      <td width="144"><div id = cedulaProveedor>
        <input name="cedRif" type="text" id="cedRif" onchange="actualizarProveedor(2)"  maxlength="9" />
      </div></td>
    </tr>
    <tr>
      <td colspan="2">Nombre</td>
      <td><input name="nombreProveedor" type="text" id="nombreProveedor" maxlength="20"/></td>
    </tr>
    <tr>
      <td colspan="2">Direccion</td>
      <td><input name="direccion" type="text" id="direccion" maxlength="40"/></td>
    </tr>
    <tr>
      <td colspan="2">Telefono</td>
      <td><input name="telefono" type="text" id="telefono" maxlength="10"/></td>
    </tr></table>';
	
	
	
?>