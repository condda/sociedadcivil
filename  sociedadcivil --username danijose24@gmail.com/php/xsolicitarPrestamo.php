 <?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel("../html/xsolicitarPrestamo.html");
		$pnlmenu->add("activo6",'id="active"');		//Coloca en Verde el link de Prestamo
		
		//Variable del otro Php
		
		$idPrestamo = $_REQUEST['idPrestamo'];
		
		//Consulta de la Base de datos
		
		$solicitanteBD = mysql_query ("SELECT * FROM persona, prestamo WHERE persona.cedulaPersona='$idPrestamo' AND 
									  prestamo.idPrestamo ='$idPrestamo'");
		//Traduccion de Datos
		
		$solicitante = mysql_fetch_assoc($solicitanteBD);
		
		//Llenado de Campos
		
		$pnlcontent->add("cedula",$solicitante['cedulaPersona']);
		$pnlcontent->add("solicitante",$solicitante['nombrePersona'].' '.$solicitante['apellidoPersona']);
		$pnlcontent->add("cuota",$solicitante['cuotaPrestamo']);
		$pnlcontent->add("montoMaximo",$solicitante['montoPrestamo']);
		
		//REQUEST
		
		$montoSolicitado = $_REQUEST['montoSolicitado'];
		
		if($montoSolicitado && ($montoSolicitado <= $solicitante['montoPrestamo']) )
		{
			mysql_query ("UPDATE prestamo SET montoPrestamo = '$montoSolicitado', estadoPrestamo = 1 WHERE idPrestamo='$idPrestamo'");
						
		}
		
		
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>