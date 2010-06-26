<?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel("../html/solicitarPrestamo.html");
		$pnlmenu->add("activo6",'id="active"');		//Coloca en Verde el link de Prestamo
	$pnlmenu->add("opcion1",'<a href="solicitarPrestamo.php">Solicitar Prestamo</a>');
		$pnlmenu->add("opcion2",'<a href="condicionesPrestamo.php">Junta Directiva - Condiciones de Prestamo</a>');
		$pnlmenu->add("opcion3",'<a href="listaFactura.php">Consultar Factura de Prestamos</a>');
		$pnlmenu->add("opcion4",'<a href="cancelarPrestamo.php">Cancelar Cuota de Prestamo</a>');
		//Consulta a Base de datos
		
		$personasBD = mysql_query("SELECT * FROM persona, prestamo_persona, prestamo 
								  WHERE prestamo_persona.estadoPrestamo = 0 and 
								  persona.cedulaPersona =	prestamo_persona.cedulaPersona AND 
								  prestamo_persona.idPrestamo = prestamo.idPrestamo");
		
		//Traduccion de Datos
		
		$personas = mysql_fetch_assoc($personasBD);
		
		//Listar Personas con Prestamos Aprobados
		
		while ($personas)
		{
			$listaPersona = $listaPersona.'<tr>
			<td>'.$personas['cedulaPersona'].'</td>
			<td>'.$personas['nombrePersona'].'</td>
			<td>'.$personas['apellidoPersona'].'</td>
			<td>'.$personas['montoPrestamo'].'</td>
			<td>'.$personas['cuotaPrestamo'].'</td>
			<td><a href="../php/xsolicitarPrestamo.php?cedula='.$personas['cedulaPersona'].'">Solicitar Prestamo</a></td>
			</tr>';
			
			$datos = $datos.'<option value="'.$personas['cedulaPersona'].'">'.$personas['nombrePersona'].' '.
			$personas['apellidoPersona'].'</option>';
			
			$personas = mysql_fetch_assoc($personasBD);
		}
		
		$algo = $_REQUEST['listaSolicitante'];
		
		if($algo)
		{
				$personasBD2 = mysql_query("SELECT * FROM persona, prestamo_persona, prestamo 
										  WHERE persona.cedulaPersona =	prestamo_persona.cedulaPersona AND 
										  prestamo_persona.idPrestamo = prestamo.idPrestamo AND
										  persona.cedulaPersona = '$algo'");
				
				//Traduccion de Datos
				
				$personas2 = mysql_fetch_assoc($personasBD2);
				
				$tabla = '<table width="100%" border="0">
							<tr>
							  <td width="9%"><strong>Cedula</strong></td>
							  <td width="9%"><strong>Nombre</strong></td>
							  <td width="9%"><strong>Apellido</strong></td>
							  <td width="23%"><strong>Monto  Permitido</strong></td>
							  <td width="21%"><strong>Numero de Cuotas para pagar</strong></td>
							  <td width="29%">&nbsp;</td>
							</tr>
							{yo}
						  </table>';
						  
						  $listaPer = $listaPer.'<tr>
							<td>'.$personas2['cedulaPersona'].'</td>
							<td>'.$personas2['nombrePersona'].'</td>
							<td>'.$personas2['apellidoPersona'].'</td>
							<td>'.$personas2['montoPrestamo'].'</td>
							<td>'.$personas2['cuotaPrestamo'].'</td>
						<td><a href="../php/xsolicitarPrestamo.php?cedula='.$personas2['cedulaPersona'].'">Solicitar Prestamo</a></td>
							</tr>';
							
							$pnlcontent->add("tabla",$tabla);
							$pnlcontent->add("yo",$listaPer);
						  
						  
		}
		
		$pnlcontent->add("nombres",$datos);
		$pnlcontent->add("listaPersonas",$listaPersona);
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>