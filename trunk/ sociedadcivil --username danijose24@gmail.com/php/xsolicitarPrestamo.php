 <?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel("../html/xsolicitarPrestamo.html");
		$pnlmenu->add("activo6",'id="active"');		//Coloca en Verde el link de Prestamo
		
		//Variable del otro Php
		
		$cedula = $_REQUEST['cedula'];
		
		//Consulta de la Base de datos
		
		$solicitanteBD = mysql_query ("SELECT * FROM persona,prestamo_persona WHERE persona.cedulaPersona='$cedula' AND 
									  prestamo_persona.cedulaPersona ='$cedula'");
								
		//Traduccion de Datos
		
		$solicitante = mysql_fetch_assoc($solicitanteBD);
		
		$id = $solicitante['idPrestamo'];
		
		$prestamoBD = mysql_query("SELECT * FROM prestamo WHERE idPrestamo = '$id'");
		
		$prestamo = mysql_fetch_assoc($prestamoBD);
		
		//Llenado de Campos
		
		$pnlcontent->add("cedula",$solicitante['cedulaPersona']);
		$pnlcontent->add("solicitante",$solicitante['nombrePersona'].' '.$solicitante['apellidoPersona']);
		$pnlcontent->add("cuota",$prestamo['cuotaPrestamo']);
		$pnlcontent->add("montoMaximo",$prestamo['montoPrestamo']);
		
		//REQUEST
		
		$montoSolicitado = $_REQUEST['montoSolicitado'];
		
		if($montoSolicitado && ($montoSolicitado <= $prestamo['montoPrestamo']) )
		{
			mysql_query ("UPDATE prestamo SET montoPrestamo = '$montoSolicitado' WHERE idPrestamo='$id'");
			mysql_query ("UPDATE prestamo_persona SET estadoPrestamo = 1 WHERE idPrestamo='$id'");
						
		}
		else if ($montoSolicitado > $prestamo['montoPrestamo'])
		{
			$pnlcontent->add("mensaje","El monto solicitado excede su monto permitido.");
		}
		
		
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>