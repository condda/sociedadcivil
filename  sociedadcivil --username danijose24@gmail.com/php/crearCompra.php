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

	$pnlcontent = new Panel("../html/crearCompra.html");
	
	extract ($_POST);
	
	$result = mysql_query ("select * from proveedor");
	while ($result1 = mysql_fetch_assoc($result)){
		$listaProveedor = $listaProveedor.'<option value="'.$result1['idProveedor'].'">'.$result1['nombreProveedor'].'</option>';
	}
	
	if($producto){
		$result = mysql_query ("select cantidadProductoProv from producto_prov where 
							   idProducto='$producto' and
							   idProveedor='$proveedor' and
							   precioProductoProv='$precio'");
		$result1 = mysql_fetch_assoc($result);
		$nueva=$result1['cantidadProductoProv']+$cantidadProducto;
		mysql_query ("update producto_prov set cantidadProductoProv='$nueva' where 
							   idProducto='$producto' and
							   idProveedor='$proveedor' and
							   precioProductoProv='$precio'");
		$multi=$cantidadProducto*$precio;
		$result = mysql_query ("insert into compra_venta (tipoCompraVenta,
														  montoCompraVenta,
														  cantidadCompraVenta,
														  idProducto,
														  idProveedor) values
							   							 ('1',
														  '$precio',
														  '$cantidadProducto',
														  '$proveedor',
														  '$producto')");
		$ultimoId = mysql_insert_id(); 
		mysql_query ("insert into egreso (tipoEgreso,
										 idCompraVenta) values
										 ('4',
										  '$ultimoId')");										 
										 
		$pnlmenu = new Panel("../html/menu.html");
		$pnlmenu->add("activo",'id="active"');
		$pnlmain = new Panel("../html/main.html");
		$pnlmain->add("nombre","Compra");
		$pnlmain->add("mensaje","Fue registrada exitosamente!");
		$pnlcontent = new Panel("../html/contentPrincipal.html");
		
		$result = mysql_query ("select * from proveedor where idProveedor='$proveedor'");
		$result1 = mysql_fetch_assoc($result);
		$result2 = mysql_query ("select * from producto where idProducto='$producto'");
		$result3 = mysql_fetch_assoc($result2);
		
		$pdf=new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Image('../imagenes/autobus3.gif',10,10,10);
		$pdf->Cell(40,30,'Sociedad Civil Colinas de Bello Monte');
		$pdf->Ln(20);
		$pdf->Cell(40,10,'-----------------------------------------------------------------------------------------------');
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,10,'Fecha: '.$date1.'');
		$pdf->Ln();
		$pdf->Cell(40,10,'Proveedor: '.$result1['nombreProveedor'].'');
		$pdf->Ln();
		$pdf->Cell(40,10,'Producto: '.$result3['nombreProducto'].'');
		$pdf->Ln();
		$pdf->Cell(40,10,'Cantidad: '.$cantidadProducto.' unidades');
		$pdf->Ln();
		$pdf->Cell(40,10,'Precio Unitario: '.$precio.' Bsf.');
		$pdf->Ln();
		$pdf->Cell(40,10,'Total: '.$cantidadProducto*$precio.' Bsf.');
		$pdf->Output();
	}
	
	$pnlcontent->add("proveedor",$listaProveedor);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	