<?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel("../html/listaFactura.html");
		
		$pnlmenu->add("activo6",'id="active"');		//Coloca en Verde el link de Prestamo
			
		//Colocar Links
$pnlmenu->add("opcion1",'<a href="solicitarPrestamo.php">Solicitar Prestamo</a>');
		$pnlmenu->add("opcion2",'<a href="condicionesPrestamo.php">Junta Directiva - Condiciones de Prestamo</a>');
		$pnlmenu->add("opcion3",'<a href="listaFactura.php">Consultar Factura de Prestamos</a>');
		$pnlmenu->add("opcion4",'<a href="cancelarPrestamo.php">Cancelar Cuota de Prestamo</a>');
		//Consulta la BD
		
		$solicitanteBD = mysql_query("Select * from persona, prestamo_persona, prestamo where prestamo_persona.estadoPrestamo = 1 AND
prestamo.idPrestamo = prestamo_persona.idPrestamo AND
persona.cedulaPersona = prestamo_persona.cedulaPersona  ;");
		
		//Traduccion de Datos
		
		$solicitante = mysql_fetch_assoc($solicitanteBD);
		
		//Listar
		
		while($solicitante)
		{
			//echo"AAAAAAAAAAAAA";
			$lista = $lista.'<tr>
			<td>'.$solicitante['cedulaPersona'].'</td>
			<td>'.$solicitante['nombrePersona'].'</td>
			<td>'.$solicitante['apellidoPersona'].'</td>
			<td>'.$solicitante['montoPrestamo'].'</td>
			<td>'.$solicitante['cuotaPrestamo'].'</td>
			<td><a href="../php/facturaPrestamo.php?idPrestamo='.$solicitante['idPrestamo'].'">Ver Factura</a></td>
			</tr>';
			
			$solicitante = mysql_fetch_assoc($solicitanteBD);
		}
		
		//Lista de Consulta
		
			//Consulta la BD
		
		$solicitanteBD2 = mysql_query("Select * from persona, prestamo_persona, prestamo where prestamo_persona.estadoPrestamo = 1 AND
										prestamo.idPrestamo = prestamo_persona.idPrestamo AND
										persona.cedulaPersona = prestamo_persona.cedulaPersona  ;");
		
		//Traduccion de Datos
		
		$solicitante2 = mysql_fetch_assoc($solicitanteBD2);
		
			while($solicitante2)
			{
						$datos = $datos.'<option value="'.$solicitante2['cedulaPersona'].'">'.$solicitante2['nombrePersona'].
						' '.$solicitante2['apellidoPersona'].'</option>';						
						
						$solicitante2 = mysql_fetch_assoc($solicitanteBD2);
			}
			
			$listaSSS = $_REQUEST['listaXXX'];
			
			if($listaSSS)
			{
				
				$solicitanteBD3 = mysql_query("Select * from persona, prestamo_persona, prestamo 
											  where prestamo_persona.estadoPrestamo = 1 AND
										prestamo.idPrestamo = prestamo_persona.idPrestamo AND
										persona.cedulaPersona = prestamo_persona.cedulaPersona and
										persona.cedulaPersona ='$listaSSS'");
				
				$solicitante3 = mysql_fetch_assoc($solicitanteBD3);
				
			
				
				$tabla = '<table width="100%" border="0">
							<tr>
							  <td class="negra">Cedula</td>
							  <td class="negra">Nombre</td>
							  <td class="negra">Apellido</td>
							  <td class="negra">Monto Solicitado</td>
							  <td class="negra">Cuotas</td>
							  <td>&nbsp;</td>
							</tr>
							{listota}
						  </table>';
						  
			$lista2 = $lista2.'<tr>
			<td>'.$solicitante3['cedulaPersona'].'</td>
			<td>'.$solicitante3['nombrePersona'].'</td>
			<td>'.$solicitante3['apellidoPersona'].'</td>
			<td>'.$solicitante3['montoPrestamo'].'</td>
			<td>'.$solicitante3['cuotaPrestamo'].'</td>
			<td><a href="../php/facturaPrestamo.php?idPrestamo='.$solicitante3['idPrestamo'].'">Ver Factura</a></td>
			</tr>';
			
			$pnlcontent->add("tabla",$tabla);
			$pnlcontent->add("listota",$lista2);
			
			}
		
		$pnlcontent->add("solicitantes",$datos);
		$pnlcontent->add("listaSolicitantes",$lista);
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>