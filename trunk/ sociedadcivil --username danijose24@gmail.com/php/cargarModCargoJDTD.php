<?php

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";

	 $flag = $_REQUEST['phpFlag'];
	 $idJuntadirectiva = $_REQUEST['phpIdJuntaDirectiva'];
	
	if ($idJuntadirectiva){
		
		$result = mysql_query("select * from juntadirectiva where idJuntadirectiva = '$idJuntadirectiva'");
	$fondo = 'bgcolor="#CCCCCC"';
	
	echo '<tr>
      <td width="175" bgcolor="#999999"><strong>Nombre Cargo</strong></td>
      <td width="183" bgcolor="#999999"><strong>Descripcion Cargo</strong></td>
      <td width="116" bgcolor="#999999">&nbsp;</td>
      
    </tr>';
	
	
	$result1 = mysql_fetch_assoc($result);

	echo '<tr>
      <td width="175" valign="middle" '.$fondo.'><input name="nombreCargo" type="text" id="nombreCargo" value="'.$result1['nombreJuntadirectiva'].'" maxlength="35" /></td>
      <td width="183"'.$fondo.'><textarea name="descripcionCargo" id="descripcionCargo" cols="45" rows="5">'.$result1['descripcionJuntadirectiva'].'</textarea></td>
      <td width="116" valign="middle"'.$fondo.'><input type="button" name="button" id="button" value="Aceptar" onclick="finalizarModJDTD('.$idJuntadirectiva.','.$flag.')" /></td>
    </tr>';
		
	
		
		
	}
		
	
	include "../db/cerrar_conexion.php";
?>
