<?php
require('../fpdf16/fpdf.php');

		$pdf=new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'Sociedad Civil Colinas de Bello Monte');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,10,'Fecha: fecha');
		$pdf->Ln();
		$pdf->Cell(40,10,'Proveedor: prov');
		$pdf->Ln();
		$pdf->Cell(40,10,'Producto: prod');
		$pdf->Ln();
		$pdf->Cell(40,10,'Cantidad: cantidad');
		$pdf->Ln();
		$pdf->Cell(40,10,'Precio Unitario: precio Bsf.');
		$pdf->Ln();
		$pdf->Cell(40,10,'Total: total Bsf.');
		$pdf->Output();
		
		/*		$pdf=new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'Sociedad Civil Colinas de Bello Monte');
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,10,'Fecha: '.$date1.'');
		$pdf->Ln();
		$pdf->Cell(40,10,'Proveedor: '.$result1['nombreProveedor'].'');
		$pdf->Ln();
		$pdf->Cell(40,10,'Producto: '.$result2['nombreProducto'].'');
		$pdf->Ln();
		$pdf->Cell(40,10,'Cantidad: '.$cantidadProducto.' unidades');
		$pdf->Ln();
		$pdf->Cell(40,10,'Precio Unitario: '.$precio.' Bsf.');
		$pdf->Ln();
		$pdf->Cell(40,10,'Total: '.$cantidadProducto*$precio.' Bsf.');
		$pdf->Output();*/

?>