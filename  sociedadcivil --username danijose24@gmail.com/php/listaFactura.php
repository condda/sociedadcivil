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
		
		
		
		
		$pnlcontent->add("listaSolicitantes",$lista);
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>