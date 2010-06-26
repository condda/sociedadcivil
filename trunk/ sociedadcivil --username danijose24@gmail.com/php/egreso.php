<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo7",'id="active"');
	$pnlmenu->add("opcion1",'<a href="ingreso.php">Ingreso</a>');
	$pnlmenu->add("opcion2",'<a href="egreso.php">Egreso</a>');
	$pnlcontent = new Panel("../html/consultarEgreso.html");
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	extract ($_POST);
	
	if(($fechaIni) && ($fechaFin))
	{
		$result =  mysql_query ("SELECT e.idEgreso, e.tipoEgreso, fe.montoFondoEgreso, fe.fechaFondoEgreso, fe.idFondo FROM egreso e, fondoegreso fe WHERE e.tipoEgreso='5' and e.idFondoEgreso=fe.idFondoEgreso and
fe.fechaFondoEgreso>='$fechaIni' and
fe.fechaFondoEgreso<='$fechaFin'");
		
		while($result2 = mysql_fetch_assoc($result))
		{	
			if ($result2['idFondo'] == '4')
				$tipo = "Retiro Voluntario";	
			else if ($result2['idFondo']=='3')
				$tipo = "Retiro por Fallecimiento";
			
			$listaEg = $listaEg.
			'<tr>
				  <td width="100" align="center">'.$result2['fechaFondoEgreso'].'</td>
				  <td width="400" align="center">'.$tipo.'</td>
				  <td width="100" align="center">'.$result2['montoFondoEgreso'].' Bsf.</td>
			</tr>';	 
		}
			
	 	$result =  mysql_query ("SELECT e.idEgreso, e.tipoEgreso, (cv.montoCompraVenta*cv.cantidadCompraVenta) as totalCompraVenta, cv.fechaCompraVenta FROM egreso e, compra_venta cv WHERE e.tipoEgreso='4' and 
e.idCompraVenta=cv.idCompraVenta and
cv.fechaCompraVenta>='$fechaIni' and
cv.fechaCompraVenta<='$fechaFin'");
		
		while($result2 = mysql_fetch_assoc($result))
		{	
			if ($result2['tipoEgreso'] == '4')
				$tipo = "Compra a Proveedor";					
			
			$listaEg = $listaEg.
			'<tr>
				  <td width="100" align="center">'.$result2['fechaCompraVenta'].'</td>
				  <td width="400" align="center">'.$tipo.'</td>
				  <td width="100" align="center">'.$result2['totalCompraVenta'].' Bsf.</td>
			</tr>';	 
		}
		
		$result =  mysql_query ("SELECT e.idEgreso, e.tipoEgreso, p.montoPrestamo, p.fechaPrestamo
								FROM egreso e, prestamo p WHERE e.tipoEgreso='6' and 
								e.idPrestamo=p.idPrestamo and
								p.fechaPrestamo>='$fechaIni' and
								p.fechaPrestamo<='$fechaFin'");
		
		while($result2 = mysql_fetch_assoc($result))
		{	
			if ($result2['tipoEgreso'] == '6')
				$tipo = "Prestamo a Persona";					
			
			$listaEg = $listaEg.
			'<tr>
				  <td width="100" align="center">'.$result2['fechaPrestamo'].'</td>
				  <td width="400" align="center">'.$tipo.'</td>
				  <td width="100" align="center">'.$result2['montoPrestamo'].' Bsf.</td>
			</tr>';	 
		}
	}
	else
		$pnlcontent->add("mensaje","Introduzca el rango de fechas!");	

	$pnlcontent->add("listaEg",$listaEg);								
	$pnlcontent->add("fechaIni",$fechaIni);								
	$pnlcontent->add("fechaFin",$fechaFin);								
	
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);

	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	