<?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel("../html/condicionesPrestamo.html");
		
		$pnlmenu->add("activo6",'id="active"');		//Coloca en Verde el link de Prestamo
		
		//Consulta a la BD
		
		$personaBD = mysql_query("SELECT * FROM persona");
		
		//Traduccion de Datos
		
		$persona = mysql_fetch_assoc($personaBD);
		
		//Llenar Lista de Solicitantes
		
		while ($persona)
		{
			$listaSolicitante = $listaSolicitante.'<option value = "'.$persona['cedulaPersona'].'">'.$persona['nombrePersona'].
			' '.$persona['apellidoPersona'].' CI: '.$persona['cedulaPersona'].'</option>';
			
			$persona = mysql_fetch_assoc($personaBD);
		}
		
		//REQUESTS
		
		$solicitante = $_REQUEST['solicitante'];
		$cuota = $_REQUEST['cuotas'];
		$montoMaximo = $_REQUEST['montoMaximo'];
		
		if($solicitante)
		{
			
			$revisionBD = mysql_query("SELECT * FROM prestamo WHERE idPrestamo = '$solicitante'");
			
			if($revision = mysql_fetch_assoc($revisionBD))
			{
				//Se Actualiza
				
				mysql_query("UPDATE prestamo SET 
													cuotaPrestamo = '$cuota',
													montoPrestamo = '$montoMaximo'
													
							WHERE idPrestamo = '$solicitante'");						
				
			}
			else
			{
					//Se crea el registro de PRESTAMO
					
					mysql_query("INSERT INTO prestamo (
													   idPrestamo,
													   montoPrestamo,
													   cuotaPrestamo
													   )
								VALUES				  (
													   '$solicitante',
													   '$montoMaximo',
													   '$cuota'
													   )");	
					
			}
		}
		
		$pnlcontent->add("listaSolicitante",$listaSolicitante);
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>