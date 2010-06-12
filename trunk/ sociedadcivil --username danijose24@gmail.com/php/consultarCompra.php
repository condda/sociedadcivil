<?php
	session_start();
	require_once ("../classes/Panel.php");
	require('../fpdf16/fpdf.php');
	include "../db/conexion.php";
	include "date.php";
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	$pnlmenu->add("opcion3",'<a href="Comprar.php">Comprar</a>');
	$pnlmenu->add("opcion4",'<a href="Venta.php">Venta</a>');

	$pnlcontent = new Panel("../html/consultarCompra.html");
	
	$result = mysql_query("select cp.*,p.nombreProducto, pr.nombreProveedor 
							from 
							compra_venta cp, producto p, proveedor pr 
							where 
							cp.tipoCompraVenta = '1' and
							cp.idProveedor = pr.idProveedor and
							cp.idProducto = p.idProducto;");
	while ($result1 = mysql_fetch_assoc($result)){
		extract($result1);
		$listaCompra = $listaCompra.
			'<tr>
			  <td>'.$idCompraVenta.'</td>
			  <td>'.$nombreProveedor.'</td>
			  <td>'.$nombreProducto.'</td>
			  <td>'.$cantidadCompraVenta.' Unid.</td>
			  <td>'.$montoCompraVenta/$cantidadCompraVenta.' Bsf.</td>
			  <td>'.$montoCompraVenta.' Bsf.</td>
			</tr>';
	}
	$pnlcontent->add("consultarCompra",$listaCompra);
		
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>