<?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel("../html/cancelarPrestamo.html");
		
		$pnlmenu->add("activo6",'id="active"');		//Coloca en Verde el link de Prestamo
		
		//Colocar Links
		
		$pnlmenu->add("opcion1",'<a href="solicitarPrestamo.php">Solicitar Prestamo</a>');
		$pnlmenu->add("opcion2",'<a href="condicionesPrestamo.php">Junta Directiva - Condiciones de Prestamo</a>');
		$pnlmenu->add("opcion3",'<a href="listaFactura.php">Consultar Factura de Prestamos</a>');
		$pnlmenu->add("opcion4",'<a href="cancelarPrestamo.php">Cancelar Cuota de Prestamo</a>');
		
		//CONSULTA BD
		
		$solicitanteBD = mysql_query("Select * from persona, prestamo_persona, prestamo 
														where  prestamo_persona.estadoPrestamo = 1 AND
														prestamo.idPrestamo = prestamo_persona.idPrestamo AND
														persona.cedulaPersona = prestamo_persona.cedulaPersona");
		
		$solicitante = mysql_fetch_assoc($solicitanteBD);
		
		while($solicitante)
		{
			
			$lista = $lista.'<tr>
			<td>'.$solicitante['cedulaPersona'].'</td>
			<td>'.$solicitante['nombrePersona'].'</td>
			<td>'.$solicitante['apellidoPersona'].'</td>
			<td>'.$solicitante['montoPrestamo'].'</td>
			<td><a href="pagoPrestamo.php?cedula='.$solicitante['cedulaPersona'].'">Cancelar Prestamo</a></td>
			</tr>';
			
			$datos = $datos.'<option value="'.$solicitante['cedulaPersona'].'">'.$solicitante['nombrePersona'].
						' '.$solicitante['apellidoPersona'].'</option>';
			
			$solicitante = mysql_fetch_assoc($solicitanteBD);
		}
		
		$seleccion = $_REQUEST['listaS'];
		
		if($seleccion)
		{
			$tabla = ' <table width="100%" border="0">
						<tr>
						  <td><strong>Cedula</strong></td>
						  <td><strong>Nombre</strong></td>
						  <td><strong>Apellido</strong></td>
						  <td><strong>Monto Solicitado</strong></td>
						  <td>&nbsp;</td>
						</tr>
						{solicitantes2}
					  </table>';
					  
		$solicitanteBD2 = mysql_query("Select * from persona, prestamo_persona, prestamo 
														where prestamo.idPrestamo = prestamo_persona.idPrestamo AND
														'$seleccion' = prestamo_persona.cedulaPersona");
		
		$solicitante2 = mysql_fetch_assoc($solicitanteBD2);
		
			$lista2 = $lista2.'<tr>
			<td>'.$solicitante2['cedulaPersona'].'</td>
			<td>'.$solicitante2['nombrePersona'].'</td>
			<td>'.$solicitante2['apellidoPersona'].'</td>
			<td>'.$solicitante2['montoPrestamo'].'</td>
			<td><a href="pagoPrestamo.php?cedula='.$solicitante2['cedulaPersona'].'">Cancelar Prestamo</a></td>
			</tr>';
			
			$pnlcontent->add("tabla",$tabla);
			$pnlcontent->add("solicitantes2",$lista2);
		
		}
		
		$pnlcontent->add("listaPer",$datos);
		$pnlcontent->add("solicitantes",$lista);
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>