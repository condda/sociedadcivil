<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo7",'id="active"');
	$pnlmenu->add("opcion1",'<a href="ingreso.php">Ingreso</a>');
	$pnlmenu->add("opcion2",'<a href="egreso.php">Egreso</a>');
	$pnlcontent = new Panel("../html/consultarIngreso.html");
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	extract ($_POST);
	
	if(($fechaIni) && ($fechaFin))
	{
		$result =  mysql_query ("SELECT i.idIngreso, i.tipoIngreso, m.montoMulta, m.fechaMulta  FROM ingreso i, multa m WHERE i.tipoIngreso='1' and i.idMulta=m.idMulta and
m.fechaMulta>='$fechaIni' and
m.fechaMulta<='$fechaFin'");
		
		while($result2 = mysql_fetch_assoc($result))
		{	
			if ($result2['tipoIngreso'] == '1')
				$tipo = "Multa";	
			
			$listaIn = $listaIn.
			'<tr>
				  <td width="100" align="center">'.$result2['fechaMulta'].'</td>
				  <td width="400" align="center">'.$tipo.'</td>
				  <td width="100" align="center">'.$result2['montoMulta'].' Bsf.</td>
			</tr>';	 
		}
			
	 	$result =  mysql_query ("SELECT i.idIngreso, i.tipoIngreso, ca.montoCuotaAvance, ca.fechaCuota  FROM ingreso i, cuota_avance ca 
WHERE 
i.tipoIngreso='2' and 
i.cedulaAvance=ca.cedulaPersona and
ca.fechaCuota>='$fechaIni' and
ca.fechaCuota<='$fechaFin'");
		
		while($result2 = mysql_fetch_assoc($result))
		{	
			if ($result2['tipoIngreso'] == '2')
				$tipo = "Pago de Cuota Avance";					
			
			$listaIn = $listaIn.
			'<tr>
				  <td width="100" align="center">'.$result2['fechaCuota'].'</td>
				  <td width="400" align="center">'.$tipo.'</td>
				  <td width="100" align="center">'.$result2['montoCuotaAvance'].' Bsf.</td>
			</tr>';	 
		}
		
		$result =  mysql_query ("SELECT i.idIngreso, i.tipoIngreso, cs.montoCuotaSocio, cs.fechaCuota  FROM ingreso i, cuota_socio cs 
WHERE 
i.tipoIngreso='2' and 
i.cedulaSocio=cs.cedulaPersona and
cs.fechaCuota>='$fechaIni' and
cs.fechaCuota<='$fechaFin'");
		
		while($result2 = mysql_fetch_assoc($result))
		{	
			if ($result2['tipoIngreso'] == '2')
				$tipo = "Pago de Cuota Socio";					
			
			$listaIn = $listaIn.
			'<tr>
				  <td width="100" align="center">'.$result2['fechaCuota'].'</td>
				  <td width="400" align="center">'.$tipo.'</td>
				  <td width="100" align="center">'.$result2['montoCuotaSocio'].' Bsf.</td>
			</tr>';	 
		}
		
	 	$result =  mysql_query ("SELECT i.idIngreso, i.tipoIngreso, insc.montoInscripcion, insc.fechaInscripcion  FROM ingreso i, inscripcion insc 
WHERE 
i.tipoIngreso='3' and 
i.idInscripcion=insc.idInscripcion and
insc.fechaInscripcion>='$fechaIni' and
insc.fechaInscripcion<='$fechaFin'");
		
		while($result2 = mysql_fetch_assoc($result))
		{	
			if ($result2['tipoIngreso'] == '3')
				$tipo = "Pago de Inscripcion";					
			
			$listaIn = $listaIn.
			'<tr>
				  <td width="100" align="center">'.$result2['fechaInscripcion'].'</td>
				  <td width="400" align="center">'.$tipo.'</td>
				  <td width="100" align="center">'.$result2['montoInscripcion'].' Bsf.</td>
			</tr>';	 
		}
		
		$result =  mysql_query ("SELECT i.idIngreso, i.tipoIngreso, (cv.montoCompraVenta*cv.cantidadCompraVenta) as totalCompraVenta, cv.fechaCompraVenta FROM ingreso i, compra_venta cv WHERE i.tipoIngreso='4' and 
i.idCompraVenta=cv.idCompraVenta and
cv.fechaCompraVenta>='$fechaIni' and
cv.fechaCompraVenta<='$fechaFin'");
		
		while($result2 = mysql_fetch_assoc($result))
		{	
			if ($result2['tipoIngreso'] == '4')
				$tipo = "Venta a Persona";					
			
			$listaIn = $listaIn.
			'<tr>
				  <td width="100" align="center">'.$result2['fechaCompraVenta'].'</td>
				  <td width="400" align="center">'.$tipo.'</td>
				  <td width="100" align="center">'.$result2['totalCompraVenta'].' Bsf.</td>
			</tr>';	 
		}
		
		$result =  mysql_query ("SELECT i.idIngreso, i.tipoIngreso, p.montoPrestamo, p.fechaPrestamo
								FROM ingreso i, prestamo p WHERE i.tipoIngreso='6' and 
								i.idPrestamo=p.idPrestamo and
								p.fechaPrestamo>='$fechaIni' and
								p.fechaPrestamo<='$fechaFin'");
		
		while($result2 = mysql_fetch_assoc($result))
		{	
			if ($result2['tipoEgreso'] == '6')
				$tipo = "Pago de Prestamo";					
			
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

	$pnlcontent->add("listaIn",$listaIn);								
	$pnlcontent->add("fechaIni",$fechaIni);								
	$pnlcontent->add("fechaFin",$fechaFin);								
	
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);

	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	