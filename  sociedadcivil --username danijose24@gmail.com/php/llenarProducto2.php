<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$consultarCodigo = $_REQUEST['phpconsultarCodigo'];
		
	if($consultarCodigo)
	{
		$result = mysql_query("SELECT cp.* , p.nombreProducto, pr.nombreProveedor
								FROM compra_venta cp, producto p, proveedor pr
								WHERE cp.tipoCompraVenta =  '1'
								AND cp.idCompraVenta='$consultarCodigo'
								AND cp.idProveedor = pr.idProveedor
								AND cp.idProducto = p.idProducto");
		if($result1 = mysql_fetch_assoc($result)){
		

			echo'<table width="250" height="0" border="0" >
			<tr><td>Codigo: '.$result1['idCompraVenta'].'</td></tr>
			<tr><td>Proveedor: '.$result1['nombreProveedor'].'</td></tr>
			<tr><td>Producto: '.$result1['nombreProducto'].'</td></tr>
			<tr><td>Cantidad: '.$result1['cantidadCompraVenta'].' Unid.</td></tr>
			<tr><td>Precio Unit.: '.$result1['montoCompraVenta']/$result1['cantidadCompraVenta'].' Bsf.</td></tr>
			<tr><td>Total: '.$result1['montoCompraVenta'].' Bsf.</td></tr>
			</table>';
		}
		else
			echo "Este codigo no existe dentro de la base de datos...";

	}
	
	include "../db/cerrar_conexion.php";
?>