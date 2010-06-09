<?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel("../html/solicitarPrestamo.html");
		$pnlmenu->add("activo6",'id="active"');		//Coloca en Verde el link de Prestamo
		
		//Consulta a Base de datos
		
		$personasBD = mysql_query("SELECT * FROM persona, prestamo WHERE persona.cedulaPersona = prestamo.idPrestamo");
		
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
			<td><a href="../php/xsolicitarPrestamo.php?idPrestamo='.$personas['cedulaPersona'].'">Solicitar Prestamo</a></td>
			</tr>';			
			$personas = mysql_fetch_assoc($personasBD);
		}
		
		
		$pnlcontent->add("listaPersonas",$listaPersona);
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>