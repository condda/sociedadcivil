<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$idProveedor = $_REQUEST['phpidProveedor'];
	$idProducto = $_REQUEST['phpidProducto'];
	$cantidadProducto = $_REQUEST['phpCantidadProducto'];
	

if ((!$idProducto) && (!$cantidadProducto)){
	
	$result = mysql_query("select * from producto_prov ProdProv, producto Prod where ProdProv.idProveedor = '$idProveedor' AND ProdProv.idProducto = Prod.idProducto");
		
	echo '<select name="producto" id="producto" Onchange="precioProducto()">';
	 echo '<option value="0">Seleccione</option>';
	 
		while ($result1 = mysql_fetch_assoc($result)){
											
		echo '<option value="'.$result1['idProducto'].'">'.$result1['nombreProducto'].'</option>';									
		}
		
		echo '</select>';
	}
 if ($idProducto){
	
	$result = mysql_query("select * from producto_prov ProdProv, producto Prod where ProdProv.idProveedor = '$idProveedor' AND ProdProv.idProducto = '$idProducto'");
	$result1 = mysql_fetch_assoc($result);
	echo $result1['precioProductoProv'];
	
}


if ($cantidadProducto){
	echo '<input type="submit" name="button" id="button" value="Comprar" />';
	
}
	
	include "../db/cerrar_conexion.php";
?>