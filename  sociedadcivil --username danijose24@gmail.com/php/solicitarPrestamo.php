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
		//Consulta a Base de datos
		
		$personasBD = mysql_query("SELECT * FROM persona, prestamo_persona, prestamo 
								  WHERE persona.cedulaPersona =	prestamo_persona.cedulaPersona AND 
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
			$personas = mysql_fetch_assoc($personasBD);
		}
		
		
		$pnlcontent->add("listaPersonas",$listaPersona);
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>