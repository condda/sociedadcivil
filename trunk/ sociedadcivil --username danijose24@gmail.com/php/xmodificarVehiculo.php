<?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
	
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel ("../html/modificarVehiculo.html");
		
		$pnlmenu->add("activo3",'id="active"');		//Coloca en Verde el link de Vehiculo
	
		//Consulta a la BD
		
		$vehiculoBD = mysql_query("SELECT * FROM vehiculo");
		
		//Traducción de Datos
		
		$vehiculo = mysql_fetch_assoc($vehiculoBD);
		
		// Llenado de la lista de vehiculos
		
		while($vehiculo)
		{
			$listaVehiculo = $listaVehiculo.'<tr>
			<td>'.$vehiculo['placaVehiculo'].'</td>
			<td>'.$vehiculo['anoVehiculo'].'</td>
			<td>'.$vehiculo['estadoVehiculo'].'</td>
			<td>'.$vehiculo['polizaVehiculo'].'</td>
			<td><a href="../php/cmodificar.php?placaVehiculo='.$vehiculo['placaVehiculo'].'">Modificar</a></td>
			</tr>';
			
			$vehiculo = mysql_fetch_assoc($vehiculoBD);
		}
		
		
		$pnlcontent->add("listaVehiculos",$listaVehiculo);	
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>