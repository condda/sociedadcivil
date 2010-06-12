<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$idProveedor = $_REQUEST['phpidProveedor'];
	$idProducto = $_REQUEST['phpidProducto'];
	$cant = $_REQUEST['phpcant'];
	$cantidadProducto = $_REQUEST['phpcantidadProducto'];
	$consultarCodigo = $_REQUEST['phpconsultarCodigo'];
	$consulta = $_REQUEST['phpconsulta'];

	if (($idProveedor) & !($idProducto)){
		$result = mysql_query("select * from producto_prov ProdProv, producto Prod where ProdProv.idProveedor = '$idProveedor' AND ProdProv.idProducto = Prod.idProducto");
		echo '<select name="producto" id="producto" Onchange="precioProducto()">';
		echo '<option value="0">Seleccione</option>';
		while ($result1 = mysql_fetch_assoc($result)){			
			echo '<option value="'.$result1['idProducto'].'">'.$result1['nombreProducto'].'</option>';									
			}
		echo '</select>';
	}
 	
	if (($idProveedor) & ($idProducto) & !($cant)){
		$result = mysql_query("select * from producto_prov ProdProv, producto Prod where ProdProv.idProveedor = '$idProveedor' AND ProdProv.idProducto = '$idProducto'");
		$result1 = mysql_fetch_assoc($result);
		
		echo '<input name="precio" type="text" id="precio" value="'.$result1['precioProductoProv'].'" readonly="readonly"  />';
	}
	
	if (($idProveedor) & ($idProducto) & ($cant)){
		$result = mysql_query("select * from producto_prov ProdProv, producto Prod where ProdProv.idProveedor = '$idProveedor' AND ProdProv.idProducto = '$idProducto'");
		$result1 = mysql_fetch_assoc($result);
		$mul=$result1['precioProductoProv']*$cant;
		echo $mul;
	}
	
	if ($cantidadProducto)
		echo '<input type="submit" name="button" id="button" onclick="windows.open()" value="Comprar" />';
		
	if(($consultarCodigo)&($consulta))
	{
		$result = mysql_query("SELECT cp.* , p.nombreProducto, pr.nombreProveedor
								FROM compra_venta cp, producto p, proveedor pr
								WHERE cp.tipoCompraVenta =  '1'
								AND cp.idCompraVenta='$consultarCodigo'
								AND cp.idProveedor = pr.idProveedor
								AND cp.idProducto = p.idProducto");
		$result1 = mysql_fetch_assoc($result);
		echo'<table width="250" height="0" border="0" >
		<tr><td>Codigo: '.$result1['idCompraVenta'].'</td></tr>
		<tr><td>Proveedor: '.$result1['nombreProveedor'].'</td></tr>
		<tr><td>Producto: '.$result1['nombreProducto'].'</td></tr>
		<tr><td>Cantidad: '.$result1['cantidadCompraVenta'].' Unid.</td></tr>
		<tr><td>Precio Unit.: '.$result1['montoCompraVenta']/$result1['cantidadCompraVenta'].' Bsf.</td></tr>
		<tr><td>Total: '.$result1['montoCompraVenta'].' Bsf.</td></tr>
		</table>';
	}
	else if($consulta)
		echo "Este codigo no existe dentro de la base de datos...";
	
	include "../db/cerrar_conexion.php";
?>